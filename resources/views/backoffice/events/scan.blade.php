@extends('backoffice.layouts.app')

@section('breadcrumb', 'Pindai Barcode')

@section('content')
<div class="w-full px-6 py-6 mx-auto">  
  @include('backoffice.events.components.scanner')
  <div id="modals"></div>
</div>
@endsection

@include('backoffice.events.components.scanner-logic')
