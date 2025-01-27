@extends('layouts.app')

{{-- Customize layout sections --}}

@section('title', 'Opportunities')
@section('content_header_title', 'Opportunities')

@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')

  @include('opportunity.partials.table')

@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush