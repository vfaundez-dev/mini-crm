@extends('layouts.app')

@section('title', 'Activity Details - ' . $activity->name)
@section('content_header_title', 'Activity')
@section('content_header_subtitle', 'Details: ' . $activity->name)

@section('plugins.Datatables', true)

@section('content_body')
<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
    <div class="btn-group">
      <a href="{{ route('activity.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
        <i class="fas fa-angle-double-left"></i> Back
      </a>
      @if(isset($activity) && $activity->completed == 0)
      <a href="{{ route('activity.edit', $activity) }}" class="btn btn-outline-light bg-info px-4">
        <i class="fas fa-edit"></i> Edit
      </a>
      @endif
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
    <div class="card card-info card-outline">
      <div class="card-body box-profile">
        <h3 class="profile-username text-info font-weight-bold text-center">Details</h3>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item border-top-0">
            <span class="float-right">
              <x-adminlte-button
                label="Notes"
                theme="info"
                class="btn-sm"
                icon="fas fa-info-circle"
                data-toggle="modal"
                data-target="#modalPurple"
              />
            </span>
          </li>
          <li class="list-group-item">
            <strong>Name</strong>
            <span class="float-right">{{ $activity->name ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Owner</strong>
            <span class="float-right">{{ $activity->owner->name ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Type</strong>
            <span class="float-right">{{ $activity->type->type ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Status</strong>
            <span class="float-right">{{ $activity->status ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Priority</strong>
            <span class="float-right">{{ $activity->priority ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Scheduled Date</strong>
            <span class="float-right">{{ $activity->scheduled_date ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>End Date</strong>
            <span class="float-right">{{ $activity->end_date ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Client</strong>
            <span class="float-right">{{ $activity->client?->name ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Contact</strong>
            <span class="float-right">{{ $activity->contact?->full_name ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Opportunity</strong>
            <span class="float-right">{{ $activity->opportunity?->name ?? 'N/A' }}</span>
          </li>
          <li class="list-group-item">
            <strong>Description</strong>
            <p>{{ $activity->description ?? 'N/A' }}</p>
          </li>
        </ul>

      </div>
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <div class="card card-info card-outline card-tabs">
      <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="activity-relations-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link text-info active" id="activity-clients-tab" data-toggle="pill" href="#activity-clients" role="tab" aria-controls="activity-clients" aria-selected="true">
              Clients
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" id="activity-contacts-tab" data-toggle="pill" href="#activity-contacts" role="tab" aria-controls="activity-contacts" aria-selected="false">
              Contacts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-info" id="activity-opportunities-tab" data-toggle="pill" href="#activity-opportunities" role="tab" aria-controls="activity-opportunities" aria-selected="false">
              Opportunities
            </a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="activity-relations-tabContent">
          <div class="tab-pane fade active show" id="activity-clients" role="tabpanel" aria-labelledby="activity-clients-tab">
              Clients Here
          </div>
          <div class="tab-pane fade" id="activity-contacts" role="tabpanel" aria-labelledby="activity-contacts-tab">
              Contacts Here
          </div>
          <div class="tab-pane fade" id="activity-opportunities" role="tabpanel" aria-labelledby="activity-opportunities-tab">
              Opportunities Here
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Notes --}}
  <x-adminlte-modal
    id="modalPurple"
    title="Activity Notes"
    theme="info"
    icon="fas fa-info-circle"
    size='lg'
  >
    <div class="bg-lightblue disabled rounded-lg border border-secondary">
      <pre class="text-light">{!! old('follow_up_notes', $activity?->follow_up_notes ?? '') !!}</pre>
    </div>
  </x-adminlte-modal>
  {{-- Modal Notes --}}

</div>
@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush