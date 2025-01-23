@extends('adminlte::page')

{{-- Extend and customize the browser title --}}

@section('title')
  {{ config('adminlte.title') }}
  @hasSection('subtitle') | @yield('subtitle') @endif
@stop

{{-- Extend and customize the page content header --}}

@section('content_header')
  @hasSection('content_header_title')
    <h1 class="text-muted">
      @yield('content_header_title')
				
      @hasSection('content_header_subtitle')
        <small class="text-dark">
          <i class="fas fa-xs fa-angle-right text-muted"></i>
          @yield('content_header_subtitle')
        </small>
      @endif
    </h1>
  @endif
@stop

{{-- Rename section content to content_body --}}

@section('content')
  @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
<div class="float-right">
  Version: {{ config('app.version', '1.0.0') }}
</div>

<strong>
  <p class="mb-1">
    {{ config('app.name') }} &copy; {{ date('Y') }}, all rights reserved. 
    Created by <a href="https://github.com/vfaundez-dev" class="text-info">Vladimir Faundez Hernandez</a>
  </p>
</strong>
@stop

{{-- Add common CSS customizations --}}

@push('css')

@endpush

{{-- Add common JS customizations --}}

@push('js')
  {{-- Toast alert messages for forms --}}
  @if (session()->has('success'))
    <x-toastr-notifications type="success" title="{{ session('success') }}" />
  @endif
  @if (session()->has('error'))
    <x-toastr-notifications type="error" title="{{ session('error') }}" />
  @endif
  {{-- Toast alert messages for forms --}}

  @vite('resources/js/app.js')
@endpush