<?php

namespace App\Http\Controllers\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jamaah;
use App\Models\EventRegistrations;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\Data\QRMatrix;

class EventController extends Controller
{
    /**
     * Display a listing of the active events.
     */
    public function index()
    {
        $events = Event::where('is_active_event', true)
            ->where('datetime_end', '>', now())
            ->orderBy('datetime_start', 'asc')
            ->get();
        return view('event.index', compact('events'));
    }

    /**
     * Display the event landing page.
     */
    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('event.show', compact('event'));
    }

    /**
     * Handle event registration.
     */
    public function register(Request $request, string $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|in:Akhwat,Ikhwan',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
        ]);

        $event = Event::where('slug', $slug)->firstOrFail();

        $jamaah =             
            Jamaah::where('email', $request->email)
            ->orWhere('phone', $request->phone)
            ->first();
        if (! $jamaah) {
            $jamaah = Jamaah::create([
                'name' => $request->name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address
            ]);
        }

        $registration = EventRegistrations::create([
            'event_id' => $event->id,
            'jamaah_id' => $jamaah->id
        ]);

        // Return JSON payload for AJAX
        return response()->json([ 'registrationId' => $registration->id ]);
    }

    /**
     * Generate QR code for the registration.
     * References: 
     * - https://smiley.codes/qrcode/
     * - https://php-qrcode.readthedocs.io/en/main/Appendix/Terminology.html#module
     * - https://php-qrcode.readthedocs.io/en/stable/Usage/Configuration-settings.html
     */
    public function generateQrCode(Request $request)
    {
        $request->validate([
            'registrationId' => 'required|string'
        ]);

        try {
            $registrationId = $request->input('registrationId');
            
            $options = new QROptions([
                'version'               => 10,
                'outputInterface'       => QRMarkupSVG::class,
                'drawLightModules'      => false,
                'svgUseFillAttributes'  => true,
                'drawCircularModules'   => true,
                'circleRadius'          => 0.45,
                'connectPaths'          => true,
                'addQuietzone'          => false,
                'moduleValues' => [
                    1536 => '#000000',
                    6    => '#ffffff',
                ],
                'keepAsSquare' => [
                    QRMatrix::M_FINDER_DARK,
                    QRMatrix::M_FINDER_DOT,
                    QRMatrix::M_ALIGNMENT_DARK,
                ],
            ]);

            $qrcode = new QRCode($options);
            $qrCodeSvg = $qrcode->render($registrationId);
            
            return response($qrCodeSvg)
                ->header('Content-Type', 'image/svg+xml')
                ->header('Cache-Control', 'public, max-age=3600');
                
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to generate QR code'], 500);
        }
    }
}
