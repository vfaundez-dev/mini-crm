@extends('layouts.app')

@section('title', 'Opportunity Details - ' . $opportunity->name)
@section('content_header_title', 'Opportunity')
@section('content_header_subtitle', 'Details: ' . $opportunity->name)

@section('plugins.Datatables', true)

@section('content_body')
<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
    <div class="btn-group">
      <a href="{{ route('opportunity.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
        <i class="fas fa-angle-double-left"></i> Back
      </a>
      @if ( intval($opportunity->status) == 0)
      <a href="{{ route('opportunity.edit', $opportunity) }}" class="btn btn-outline-light bg-info px-4">
        <i class="fas fa-edit"></i> Edit
      </a>
      @endif
    </div>
  </div>

  {{-- Column 1 --}}
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
    <div class="card card-info card-outline">
        <div class="card-body box-profile">
          <h3 class="profile-username text-info font-weight-bold text-center">Details</h3>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <strong>Name</strong>
              <span class="float-right">{{ $opportunity->name ?? 'N/A' }}</span>
            </li>
            <li class="list-group-item">
              <strong>Status</strong>
              <span class="float-right">{{ $listStatus[$opportunity->status] ?? 'N/A' }}</span>
            </li>
            <li class="list-group-item">
              <strong>Stage</strong>
              <span class="float-right">{{ $opportunity->stage->stage ?? 'N/A' }}</span>
            </li>
            <li class="list-group-item">
              <strong>Owner</strong>
              <span class="float-right">{{ $opportunity->owner->name ?? 'N/A' }}</span>
            </li>
            <li class="list-group-item">
              <strong>Client</strong>
              <span class="float-right">{{ $opportunity->client->name ?? 'N/A' }}</span>
            </li>
            <li class="list-group-item">
              <strong>Source</strong>
              <span class="float-right">{{ $opportunity->source ?? 'N/A' }}</span>
            </li>
            <li class="list-group-item">
              <strong>Created</strong>
              <span class="float-right">{{ $opportunity->created_date ?? 'N/A' }}</span>
            </li>
          </ul>
        </div>
    </div>
  </div>
  {{-- Column 1 --}}

  {{-- Column 2 --}}
  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    {{-- Sub Column 1 --}}
    <div class="card card-info card-outline">
      <div class="card-body box-profile">
        <h3 class="profile-username text-right text-lightblue font-weight-bold">
          <span class="text-gray">Success Probability:</span>
          {{ number_format($opportunity->success_probability, 2, '.', ',') ?? 0 }}%
        </h3>

        <div class="row">
          
          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <x-adminlte-info-box
              title="Estimated Close Date"
              text="{{ $opportunity->estimated_close_date ?? 'N/A' }}"
              icon="far fa-lg fa-calendar-times text-info"
              theme="gradient-info"
              icon-theme="white"
            />
          </div>

          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <x-adminlte-info-box
              title="Actual Close Date"
              text="{{ $opportunity->actual_close_date ?? 'N/A' }}"
              icon="fas fa-lg fa-calendar-times text-lightblue"
              theme="gradient-lightblue"
              icon-theme="white"
            />
          </div>

          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <x-adminlte-info-box
              title="Estimated Value"
              text="{{ number_format($opportunity->estimated_value, 2, '.', ',') ?? 'N/A' }}"
              icon="fas fa-lg fa-search-dollar text-teal"
              theme="gradient-teal"
              icon-theme="white"
            />
          </div>

          <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <x-adminlte-info-box
              title="Weighted Value"
              text="{{ number_format($opportunity->weighted_value, 2, '.', ',') ?? 'N/A' }}"
              icon="fas fa-lg fa-hand-holding-usd text-olive"
              theme="gradient-olive"
              icon-theme="white"
            />
          </div>
          
        </div>
      </div>
    </div>
    {{-- Sub Column 1 --}}

    {{-- Sub Column 2 --}}
    <div class="card card-info card-outline card-tabs">
      <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="opportunity-relations-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link text-info active" id="opportunity-clients-tab" data-toggle="pill" href="#opportunity-clients" role="tab" aria-controls="opportunity-clients" aria-selected="true">
              Clients
            </a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="opportunity-relations-tabContent">
          <div class="tab-pane fade active show" id="opportunity-clients" role="tabpanel" aria-labelledby="opportunity-clients-tab">
            @include('client.partials.table', [ 'clients' => [ $opportunity->client ] ])
          </div>
        </div>
      </div>
    </div>
    {{-- Sub Column 2 --}}
  </div>
  {{-- Column 2 --}}

</div>
@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush