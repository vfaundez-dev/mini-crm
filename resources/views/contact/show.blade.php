@extends('layouts.app')

@section('title', 'Contact Details - ' . $contact->full_name)
@section('content_header_title', 'Contact')
@section('content_header_subtitle', 'Details: ' . $contact->full_name)

@section('content_body')
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
        <div class="btn-group">
            <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
                <i class="fas fa-angle-double-left"></i> Back
            </a>
            <a href="{{ route('contact.edit', $contact) }}" class="btn btn-outline-light bg-info px-4">
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
                        <strong>First Name</strong>
                        <span class="float-right">{{ $contact->first_name ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Last Name</strong>
                        <span class="float-right">{{ $contact->last_name ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Gender</strong>
                        <span class="float-right">{{ $contact->gender ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Job Title</strong>
                        <span class="float-right">{{ $contact->job_title->job_title ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Department</strong>
                        <span class="float-right">{{ $contact->department->department ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Client</strong>
                        <span class="float-right">{{ $contact->client->name ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Email</strong>
                        <span class="float-right">{{ $contact->email ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Phone</strong>
                        <span class="float-right">{{ $contact->phone ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Address</strong>
                        <span class="float-right">{{ $contact->address ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Country</strong>
                        <span class="float-right">{{ $contact->country ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>State</strong>
                        <span class="float-right">{{ $contact->state ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>City</strong>
                        <span class="float-right">{{ $contact->city ?? 'N/A' }}</span>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
        <div class="card card-info card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="contact-relations-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-info active" id="contact-activities-tab" data-toggle="pill" href="#contact-activities" role="tab" aria-controls="contact-activities" aria-selected="false">
                            Activities
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="contact-relations-tabContent">
                    <div class="tab-pane fade active show" id="contact-activities" role="tabpanel" aria-labelledby="contact-activities-tab">
                        
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