@extends('layouts.app')

@section('title', 'Dashboard')
@section('content_header_title')
<span class="text-info font-weight.bold">
  Welcome {{ Auth::user()->name ?? 'User' }}
</span>
@stop

@section('content_body')
  <p>Welcome to this beautiful admin panel.</p>
@stop

@push('css')

@endpush


@push('js')

@endpush