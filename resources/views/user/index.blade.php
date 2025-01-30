@extends('layouts.app')

{{-- Customize layout sections --}}

@section('title', 'Users')
@section('content_header_title', 'Users')

@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')

  @include('user.partials.table')

@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush