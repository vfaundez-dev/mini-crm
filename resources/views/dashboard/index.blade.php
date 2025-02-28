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
      theme="teal"
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

  {{-- Opp Pipeline --}}
  <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-xs-12">
    <x-adminlte-card title="Opportunities Pipeline" theme="purple" icon="fas fa-chart-pie" maximizable>
      <canvas id="chartOppPipeline" class="my-2 my-lg-5" data-opppipeline='@json($getOpportunitiesPipeline)'></canvas>
    </x-adminlte-card>
  </div>
  {{-- Opp Pipeline --}}

  {{-- Activities Status --}}
  <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-xs-12">
    <x-adminlte-card title="Activities Status" theme="lightblue" icon="fas fa-info">

      {{-- Item Activities --}}
      <div class="d-flex justify-content-between align-items-center border-bottom mb-3 text-secondary">
        <p class="text-xl">
          <i class="fas fa-ellipsis-h"></i>
        </p>
        <p class="d-flex flex-column text-right">
          <span class="font-weight-bold text-xl">
            {{ $getActivitiesProgress['pending'] ?? 0 }}
          </span>
          <span class="text-muted">PENDING</span>
        </p>
      </div>
      {{-- Item Activities --}}

      {{-- Item Activities --}}
      <div class="d-flex justify-content-between align-items-center border-bottom mb-3 text-info">
        <p class="text-xl">
          <i class="fas fa-spinner"></i>
        </p>
        <p class="d-flex flex-column text-right">
          <span class="font-weight-bold text-xl">
            {{ $getActivitiesProgress['in_progress'] ?? 0 }}
          </span>
          <span class="text-muted">IN PROGRESS</span>
        </p>
      </div>
      {{-- Item Activities --}}

      {{-- Item Activities --}}
      <div class="d-flex justify-content-between align-items-center border-bottom mb-3 text-success">
        <p class="text-xl">
          <i class="fas fa-check"></i>
        </p>
        <p class="d-flex flex-column text-right">
          <span class="font-weight-bold text-xl">
            {{ $getActivitiesProgress['completed'] ?? 0 }}
          </span>
          <span class="text-muted">COMPLETED</span>
        </p>
      </div>
      {{-- Item Activities --}}

      {{-- Item Activities --}}
      <div class="d-flex justify-content-between align-items-center border-bottom mb-2 text-danger">
        <p class="text-xl">
          <i class="fas fa-times"></i>
        </p>
        <p class="d-flex flex-column text-right">
          <span class="font-weight-bold text-xl">
            {{ $getActivitiesProgress['canceled'] ?? 0 }}
          </span>
          <span class="text-muted">CANCELED</span>
        </p>
      </div>
      {{-- Item Activities --}}

    </x-adminlte-card>
  </div>
  {{-- Activities Status --}}

  <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12 col-xs-12">

    {{-- Opp Values --}}
    <div class="row">
      <div class="col-md-12">
        <x-adminlte-card class="bg-purple">
          <div class="row p-0">

            {{-- Value Block --}}
            <div class="col-sm-6 col-6 border-right">
              <div class="description-block">
                <h4 class="font-weight-bold mb-0">${{ $opportunitiesEstimatedRevenue ?? '0.0' }}</h4>
                <span class="description-text">ESTIMATED REVENUE</span>
              </div>
            </div>
            {{-- Value Block --}}

            {{-- Value Block --}}
            <div class="col-sm-6 col-6">
              <div class="description-block">
                <h4 class="font-weight-bold mb-0">${{ $totalValue ?? '0.0' }}</h4>
                <span class="description-text">TOTAL VALUE</span>
              </div>
            </div>
            {{-- Value Block --}}

          </div>
        </x-adminlte-card>
      </div>
    </div>
    {{-- Opp Values --}}

    {{-- Opp by Stage --}}
    <div class="row">
      <div class="col-md-12">
        <x-adminlte-card title="Opportunities by Stage" theme="purple" icon="fas fa-chart-pie" maximizable>
          <canvas id="chartOppByStage" class="my-3" data-oppstage='@json($opportunitiesByStage)'></canvas>
        </x-adminlte-card>
      </div>
    </div>
    {{-- Opp by Stage --}}

  </div>

</div>

<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
    <x-adminlte-card
      title="Last Activities"
      theme="lightblue"
      icon="fas fa-clipboard-list"
      body-class="bg-lightblue p-0"
      collapsible
    >
      <div class="table-responsive">
        <table id="table-activities" class="table m-0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Status</th>
              <th>Priority</th>
              <th>Scheduled Date</th>
              <th>End Date</th>
              <th>Owner</th>
              <th>Completed</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($getLastActivities as $activity)
            <tr>
              <td>
                <a href="{{ route('activity.edit', $activity['id']) }}" class="text-white font-weight-bold">
                  {{ $activity['id'] }}
                </a>
              </td>
              <td>{{ $activity['name'] ?? '' }}</td>
              <td>{{ $activity['status'] ?? '' }}</td>
              <td>{{ $activity['priority'] ?? '' }}</td>
              <td>{{ \Carbon\Carbon::parse( $activity['scheduled_date'] )->format('Y-m-d') ?? '' }}</td>
              <td>{{ \Carbon\Carbon::parse( $activity['end_date'] )->format('Y-m-d') ?? '' }}</td>
              <td>{{ $activity['owner'] ?? '' }}</td>
              <td class="text-center">
                <span class="badge {{ $activity['completed'] ? 'badge-success' : 'badge-danger' }} text-md">
                  {{ $activity['completed'] ? 'YES' : 'NO' }}
                </span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </x-adminlte-card>
  </div>
  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

  </div>
</div>

@stop

@push('css')

@endpush


@push('js')

@endpush