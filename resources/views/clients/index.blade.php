@extends('layouts.app')

{{-- Customize layout sections --}}

@section('title', 'Clients')
@section('content_header_title', 'Clients')

@section('plugins.Datatables', true)

{{-- Content body: main page content --}}


@section('content_body')

@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush