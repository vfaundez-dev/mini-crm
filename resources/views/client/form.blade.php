@extends('layouts.app')

{{-- Customize layout sections --}}

@section('title', 'Clients')
@section('content_header_title', 'Clients')
@section('content_header_subtitle', 'New Client')

{{-- Content body: main page content --}}

@section('content_body')
{{-- Client Form --}}
<form action="{{ (isset($client) && $client?->id) ? route('client.update', $client) : route('client.store') }}" method="POST">
  <div class="row">
    @csrf
    @if (isset($client) && $client?->id)
      @method('PUT')
    @endif

    {{-- Actions --}}
    <div class="col-12 mb-2">
      <div class="btn-group">
        <a href="{{ route('client.index') }}" class="btn btn-primary mr-2">
          <i class="fas fa-arrow-left"></i>
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

    {{-- Column 1 --}}
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="row">
        {{-- Section 1 --}}
        <div class="col-12">
          <div class="card card-outline card-primary">
            <div class="card-body">

              <x-adminlte-input
                type="text"
                id="name"
                name="name"
                label="Name"
                placeholder="Client name..."
                value="{{ old('name', $client?->name ?? '') }}"
                required
              ></x-adminlte-input>

              <x-adminlte-select
                id="status_id"
                name="status_id"
                label="Status"
                data-placeholder="Select status..."
                data-allow-clear="true"
                data-cache="false"
                required
              >
                @foreach ($clientStatus as $status)
                  <option value="{{ $status->id }}" {{ old('status_id', $client?->status_id ?? '') == $status->id ? 'selected' : '' }}>
                    {{ $status->status }}
                  </option>
                @endforeach
              </x-adminlte-select>

              <x-adminlte-select
                id="type_id"
                name="type_id"
                label="Type"
                data-placeholder="Select type..."
                data-allow-clear="true"
                data-cache="false"
                required
              >
                @foreach ($clientTypes as $type)
                  <option value="{{ $type->id }}" {{ old('type_id', $client?->type_id ?? '') == $type->id ? 'selected' : '' }}>
                    {{ $type->type }}
                  </option>
                @endforeach
              </x-adminlte-select>

              <x-adminlte-select
                id="industry_id"
                name="industry_id"
                label="Industry"
                data-placeholder="Select industry..."
                data-allow-clear="true"
                data-cache="false"
              >
                @foreach ($clientIndustries as $industry)
                  <option value="{{ $industry->id }}" {{ old('industry_id', $client?->industry_id ?? '') == $industry->id ? 'selected' : '' }}>
                    {{ $industry->industry }}
                  </option>
                @endforeach
              </x-adminlte-select>

              <x-adminlte-select
                id="owner_id"
                name="owner_id"
                label="Owner"
                data-placeholder="Select owner..."
                data-allow-clear="true"
                data-cache="false"
                required
              >
                @foreach ($owners as $owner)
                  <option value="{{ $owner->id }}" {{ old('owner_id', $client?->owner_id ?? Auth::user()->id) == $owner->id ? 'selected' : '' }}>
                    {{ $owner->name }}
                  </option>
                @endforeach
              </x-adminlte-select>

            </div>
          </div>
        </div>
        {{-- Section 1 --}}

        {{-- Section 2 --}}
        <div class="col-12">
          <div class="card card-outline card-primary">
            <div class="card-body">

              <x-adminlte-input
                type="text"
                id="city"
                name="city"
                label="City"
                placeholder="City..."
                value="{{ old('city', $client?->city ?? '') }}"
                required
              ></x-adminlte-input>
                
            </div>
          </div>
        </div>
        {{-- Section 2 --}}

      </div>
    </div>
    {{-- Column 1 --}}

    {{-- Column 2 --}}
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card card-outline card-primary">
        <div class="card-body">

          <x-adminlte-input
            type="mail"
            id="email"
            name="email"
            label="Email"
            placeholder="Email..."
            fgroup-class="col-12"
            class="bg-white"
            value="{{ old('email', $client?->email ?? '') }}"
            required
          />

          <x-adminlte-input
            type="text"
            id="main_phone"
            name="main_phone"
            label="Main Phone"
            placeholder="+56 ...."
            fgroup-class="col-12"
            class="bg-white"
            value="{{ old('main_phone', $client?->main_phone ?? '') }}"
            required
          />

          <x-adminlte-input
            type="text"
            id="secondary_phone"
            name="secondary_phone"
            label="Secondary Phone"
            placeholder="+56 ..."
            fgroup-class="col-12"
            value="{{ old('secondary_phone', $client?->secondary_phone ?? '') }}"
            class="bg-white"
          />

          <x-adminlte-input
            type="text"
            id="address_1"
            name="address_1"
            label="Main Address"
            placeholder="Address..."
            fgroup-class="col-12"
            class="bg-white"
            value="{{ old('address_1', $client?->address_1 ?? '') }}"
            required
          />

          <x-adminlte-input
            type="text"
            id="address_2"
            name="address_2"
            label="Address 2"
            placeholder="Address..."
            fgroup-class="col-12"
            value="{{ old('address_2', $client?->address_2 ?? '') }}"
            class="bg-white"
          />

          <x-adminlte-input
            type="text"
            id="address_3"
            name="address_3"
            label="Address 3"
            placeholder="Address..."
            fgroup-class="col-12"
            value="{{ old('address_3', $client?->address_3 ?? '') }}"
            class="bg-white"
          />

          <x-adminlte-input
            type="text"
            id="website"
            name="website"
            label="Website"
            placeholder="http://miwebsite.com"
            fgroup-class="col-12"
            value="{{ old('website', $client?->website ?? '') }}"
            class="bg-white"
          />

        </div>
      </div>
    </div>
    {{-- Column 2 --}}

  </div>
</form>
{{-- Client Form --}}
@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush