@extends('layouts.app')

{{-- Customize layout sections --}}

@section('title', 'Contacts')
@section('content_header_title', 'Contacts')

@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')

  @include('contact.partials.table')

@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush