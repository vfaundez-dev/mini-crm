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
      :title="$totals['clients']"
      text="Total Clients"
      icon="fas fa-user-tie text-light"
      theme="info"
      :url="route('client.index')"
      url-text="View all clients"
    />
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <x-adminlte-small-box
      :title="$totals['contacts']"
      text="Total Contacts"
      icon="fas fa-address-book text-light"
      theme="olive"
      :url="route('contact.index')"
      url-text="View all contacts"
    />
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <x-adminlte-small-box
      :title="$totals['activities']"
      text="Total Activities"
      icon="fas fa-clipboard-list text-light"
      theme="lightblue"
      :url="route('activity.index')"
      url-text="View all activities"
    />
  </div>
  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
    <x-adminlte-small-box
      :title="$totals['opportunities']"
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
  <div class="col-3">
    <x-adminlte-card title="Opportunities by Stage" theme="purple" icon="fas fa-chart-pie" maximizable>
      <canvas id="chartOppByStage"></canvas>
    </x-adminlte-card>
  </div>
</div>

@stop

@push('css')

@endpush


@push('js')
<script id="opportunities-data" type="application/json">
  {!! json_encode($opportunitiesByStage) !!}
</script>
@endpush