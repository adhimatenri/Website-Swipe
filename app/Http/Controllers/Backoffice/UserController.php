<?php
namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;


class UserController extends Controller
{


    public function data(Request $request)
    {
        $query = User::with('role'); // relasi ke Role
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('role', function ($user) {
                return $user->role->name ?? '-';
            })
            ->addColumn('gender', function ($user) {
                return $user->gender ?? '-';
            })
            ->addColumn('action', function ($user) {
                return view('backoffice.users.partials.action', compact('user'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    

    public function index()
    {
        return view('backoffice.users.index');
    }
    

    public function create()
    {
        $roles = Role::all(); // ambil seluruh kolom, jadi objek
        return view('backoffice.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'phone' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        return redirect()->route('backoffice.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id'); // ['id' => 'name']
        return view('backoffice.users.edit', compact('user', 'roles'));
    }
    

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'required|exists:roles,id',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed'
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('backoffice.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }
}
