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

  <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
    <div class="row">
      {{-- Last Activities --}}
      <div class="col-md-12">
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
      {{-- Last Activities --}}
      {{-- Last Clients --}}
      <div class="col-md-12">
        <x-adminlte-card
          title="Last Clients"
          theme="teal"
          icon="fas fa-user-tie"
          body-class="bg-teal p-0"
          collapsible
        >
          <div class="table-responsive">
            <table id="table-activities" class="table m-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Status</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Country</th>
                  <th>Owner</th>
                  <th>Type</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getLastClients as $client)
                <tr>
                  <td>
                    <a href="{{ route('client.edit', $client['id']) }}" class="text-white font-weight-bold">
                      {{ $client['id'] }}
                    </a>
                  </td>
                  <td>{{ $client['status']['status'] ?? '' }}</td>
                  <td>{{ $client['name'] ?? '' }}</td>
                  <td>{{ $client['email'] ?? '' }}</td>
                  <td>{{ $client['country'] ?? '' }}</td>
                  <td>{{ $client['owner'] ?? '' }}</td>
                  <td>{{ $client['type']['type'] ?? '' }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </x-adminlte-card>
      </div>
      {{-- Last Clients --}}
    </div>
  </div>

  {{-- Top Users Won Opportunities --}}
  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
    <x-adminlte-card title="Top 3 Users - Won Opportunities" theme="purple" body-class="bg-purple p-1" icon="fas fa-trophy" collapsible>
      <div class="row">
      @foreach ($topUsersClosedWonOpp as $key => $topUser )
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12">
          <div class="card card-widget widget-user-2 elevation-4">
            <div class="widget-user-header bg-gradient-lightblue text-right" style="">
              <div class="widget-user-image">
                <img
                  class="img-circle elevation-2 bg-light p-2"
                  src="{{ asset('img/medal_'. $key+1 .'.png') }}"
                  alt="Medal Img"
                >
              </div>
              <h3 class="widget-user-username mb-0 font-weight-bold text-xl">{{ $topUser->name ?? 'Unknown' }}</h3>
              <h5 class="widget-user-desc text-sm">{{ $topUser->email ?? '-' }}</h5>
            </div>
            <div class="card-footer bg-gradient-light py-0">
              <div class="row">
                <div class="col-6 border-right border-muted">
                  <div class="description-block">
                    <span class="description-header text-secondary text-sm">CLOSED WON</span>
                    <h4 class="description-text text-success font-weight-bold">
                      {{ $topUser->total_opportunities ?? 0}}
                    </h3>
                  </div>
                </div>
                <div class="col-6 text-fuchsia font-weight-bold">
                  <div class="description-block">
                    <span class="description-header text-secondary text-sm">TOTAL</span>
                    <h4 class="description-text text-success font-weight-bold">
                      ${{ number_format($topUser->total_value, 2, ',', '.') ?? 0}}
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </x-adminlte-card>
  </div>
  {{-- Top Users Won Opportunities --}}

</div>

@stop

@push('css')

@endpush


@push('js')

@endpush