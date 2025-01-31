@extends('layouts.app')

@section('title', 'Dashboard')
@section('content_header_title')
<h4 class="text-info font-weight-bold">
  Welcome {{ Auth::user()->name ?? 'User' }}
</h4>
@stop

@section('plugins.Chartjs', true)

@section('content_body')

{{-- Widgets --}}
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <x-adminlte-small-box
      :title="$clients->count()"
      text="Total Clients"
      icon="fas fa-user-tie text-light"
      theme="info"
      :url="route('client.index')"
      url-text="View all clients"
    />
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <x-adminlte-small-box
      :title="$contacts->count()"
      text="Total Contacts"
      icon="fas fa-address-book text-light"
      theme="olive"
      :url="route('contact.index')"
      url-text="View all contacts"
    />
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <x-adminlte-small-box
      :title="$activities->count()"
      text="Total Activities"
      icon="fas fa-clipboard-list text-light"
      theme="lightblue"
      :url="route('activity.index')"
      url-text="View all activities"
    />
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <x-adminlte-small-box
      :title="$opportunities->count()"
      text="Total Oportunities"
      icon="fas fa-hand-holding-usd text-light"
      theme="purple"
      :url="route('opportunity.index')"
      url-text="View all oportunities"
    />
  </div>
</div>
{{-- Widgets --}}

<div class="row">
  <div class="col-6">
    <canvas id="chart1"></canvas>
  </div>
</div>

@stop

@push('css')

@endpush


@push('js')
<script>

</script>
@endpush