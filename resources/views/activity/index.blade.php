@extends('layouts.app')

{{-- Customize layout sections --}}

@section('title', 'Activities')
@section('content_header_title', 'Activities')

@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')

  @include('activity.partials.table')

@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush