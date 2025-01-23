@extends('layouts.app')

@section('title', 'Clients')
@section('content_header_title', 'Clients')
@section('content_header_subtitle', 'Details '.$client->name)

@section('plugins.Datatables', true)

@section('content_body')
<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
    <div class="btn-group">
      <a href="{{ route('client.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
        <i class="fas fa-angle-double-left"></i> Back
      </a>
      <a href="{{ route('client.edit', $client) }}" class="btn btn-outline-light bg-info px-4">
        <i class="fas fa-edit"></i> Edit
      </a>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
    <div class="card card-info card-outline">
      <div class="card-body box-profile">
        <h3 class="profile-username text-info font-weight-bold text-center">Details</h3>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <strong>Name</strong>
            <span class="float-right">{{ $client->name ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Status</strong>
            <span class="float-right">{{ $client->status->status ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Type</strong>
            <span class="float-right">{{ $client->type->type ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Industry</strong>
            <span class="float-right">{{ $client->industry->industry ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Owner</strong>
            <span class="float-right">{{ $client->owner->name ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Country</strong>
            <span class="float-right">{{ $client->country ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>State</strong>
            <span class="float-right">{{ $client->state ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>City</strong>
            <span class="float-right">{{ $client->city ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Email</strong>
            <span class="float-right">{{ $client->email ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Main Phone</strong>
            <span class="float-right">{{ $client->main_phone ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Secondary Phone</strong>
            <span class="float-right">{{ $client->secondary_phone ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Main Address</strong>
            <span class="float-right">{{ $client->address_1 ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Address 2</strong>
            <span class="float-right">{{ $client->address_2 ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Address 3</strong>
            <span class="float-right">{{ $client->address_3 ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Website</strong>
            <span class="float-right">
              <a class="text-info" href="{{ $client->website ?? '#' }}" target="_blank">{{ $client->website ?? 'N/A' }}</a>
            </span>
          </li>
        </ul>

      </div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <div class="card card-info card-outline card-tabs">
      <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="client-relations-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link text-info active" id="client-contacts-tab" data-toggle="pill" href="#client-contacts" role="tab" aria-controls="client-contacts" aria-selected="true">
              Contacts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" id="client-opportunities-tab" data-toggle="pill" href="#client-opportunities" role="tab" aria-controls="client-opportunities" aria-selected="false">
              Opportunities
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" id="client-activities-tab" data-toggle="pill" href="#client-activities" role="tab" aria-controls="client-activities" aria-selected="false">
              Activities
            </a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="client-relations-tabContent">
          <div class="tab-pane fade active show" id="client-contacts" role="tabpanel" aria-labelledby="client-contacts-tab">
              
          </div>
          <div class="tab-pane fade" id="client-opportunities" role="tabpanel" aria-labelledby="client-opportunities-tab">
              
          </div>
          <div class="tab-pane fade" id="client-activities" role="tabpanel" aria-labelledby="client-activities-tab">
              
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush