@extends('layouts.app')

@section('title', isset($contact) ? 'Edit Contact' : 'New Contact')
@section('content_header_title', 'Contacts')
@section('content_header_subtitle', isset($contact) ? 'Edit Contact' : 'New Contact')

@section('content_body')
<form action="{{ (isset($contact) && $contact?->id) ? route('contact.update', $contact) : route('contact.store') }}" method="POST">
  <div class="row">
    @csrf
    @if (isset($contact) && $contact?->id)
      @method('PUT')
    @endif

    {{-- Actions --}}
    <div class="col-12 mb-2">
      <div class="btn-group">
        <a href="{{ route('contact.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
          <i class="fas fa-angle-double-left"></i> Back
        </a>
        <x-adminlte-button
          class="btn-flat"
          type="submit"
          label="Save"
          theme="success"
          icon="fas fa-lg fa-save"
        />
      </div>
    </div>
    {{-- Actions --}}

    {{-- Column1 --}}
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card card-outline card-primary">
        <div class="card-body">

          <x-adminlte-input
            type="text"
            id="first_name"
            name="first_name"
            label="First Name"
            placeholder="Your first name..."
            value="{{ old('first_name', $contact?->first_name ?? '') }}"
            required
          />

          <x-adminlte-input
            type="text"
            id="last_name"
            name="last_name"
            label="Last Name"
            placeholder="Your last name..."
            value="{{ old('last_name', $contact?->last_name ?? '') }}"
          />

          <x-adminlte-select
            id="gender"
            name="gender"
            label="Gender"
            placeholder="Gender.."
            required
          >
            @foreach (['male', 'female', 'other'] as $gender)
            <option value="{{ $gender }}" {{ old('gender', $contact?->gender ?? '') === $gender ? 'selected' : '' }}>
              {{ ucfirst($gender) }}
            </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select
            id="job_title_id"
            name="job_title_id"
            label="Job Title"
            data-placeholder="Select job title..."
            data-allow-clear="true"
            data-cache="false"
            required
          >
            @foreach ($jobsTitles as $job_title)
            <option value="{{ $job_title->id }}" {{ old('job_title_id', $contact?->job_title_id ?? '') == $job_title->id ? 'selected' : '' }}>
              {{ $job_title->job_title }}
            </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select
            id="department_id"
            name="department_id"
            label="Department"
            data-placeholder="Select department..."
            data-allow-clear="true"
            data-cache="false"
            required
          >
            @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ old('department_id', $contact?->department_id ?? '') == $department->id ? 'selected' : '' }}>
              {{ $department->department }}
            </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select2
            id="client_id"
            name="client_id"
            label="Client"
            data-placeholder="Select a client..."
            data-allow-clear="true"
            data-cache="false"
            required
          >
            @foreach ($clients as $client)
            <option value="{{ $client->id }}" {{ old('client_id', $contact?->client_id ?? '') == $client->id ? 'selected' : '' }}>
              {{ $client->name }}
            </option>
            @endforeach
          </x-adminlte-select2>

        </div>
      </div>
    </div>
    {{-- Column1 --}}

    {{-- Column 2 --}}
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card card-outline card-primary">
        <div class="card-body">

          <x-adminlte-input
            type="email"
            id="email"
            name="email"
            label="Email"
            placeholder="Your email..."
            value="{{ old('email', $contact?->email ?? '') }}"
            required
          />

          <x-adminlte-input
            type="text"
            id="phone"
            name="phone"
            label="Phone"
            placeholder="Your phone..."
            value="{{ old('phone', $contact?->phone ?? '') }}"
          />

          <x-adminlte-input
            type="text"
            id="address"
            name="address"
            label="Address"
            placeholder="Your address..."
            value="{{ old('address', $contact?->address ?? '') }}"
          />

          <x-adminlte-input
            type="text"
            id="country"
            name="country"
            label="Country"
            placeholder="Your country..."
            value="{{ old('country', $contact?->country ?? '') }}"
          />

          <x-adminlte-input
            type="text"
            id="state"
            name="state"
            label="State"
            placeholder="Your state..."
            value="{{ old('state', $contact?->state ?? '') }}"
          />

          <x-adminlte-input
            type="text"
            id="city"
            name="city"
            label="City"
            placeholder="Your city..."
            value="{{ old('city', $contact?->city ?? '') }}"
          />

        </div>
      </div>
    </div>
    {{-- Column 2 --}}

  </div>
</form>
@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush