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
      <a href="{{ route('activity.edit', $activity) }}" class="btn btn-outline-light bg-info px-4">
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
    <div class="card card-info card-outline">
      <div class="card-body box-profile">
        <h4 class="profile-username font-weight-bold text-info text-center">Notes</h4>
        <div class="bg-lightblue disabled rounded-lg">
          <pre class="text-light">{!! old('follow_up_notes', $activity?->follow_up_notes ?? '') !!}</pre>
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