@extends('layouts.app')

{{-- Customize layout sections --}}

@section('title', isset($activity) ? 'Edit Activity' : 'New Activity')
@section('content_header_title', 'Activities')
@section('content_header_subtitle', isset($activity) ? 'Edit Activity' : 'New Activity')

@section('content_body')
<form id="formActivity" action="{{ (isset($activity) && $activity?->id) ? route('activity.update', $activity) : route('activity.store') }}" method="POST">
  <div class="row">
    @csrf
    @if (isset($activity) && $activity?->id)
      @method('PUT')
    @endif

    {{-- Actions --}}
    <div class="col-12 mb-2">
      <div class="btn-group">
        <a href="{{ route('activity.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
          <i class="fas fa-angle-double-left"></i> Back
        </a>
        <x-adminlte-button
          class="btn-flat mr-1"
          type="submit"
          label="Save"
          theme="success"
          icon="fas fa-lg fa-save"
        />
        @if($activity && $activity->completed == 0)
        <x-adminlte-button
          id="btnComplete"
          label="Finish"
          theme="dark"
          type="button"
          icon="fas fa-check-square"
        />
        @endif
      </div>
    </div>
    {{-- Actions --}}

    {{-- Column 1 --}}
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card card-outline card-primary">
        <div class="card-body">

          <x-adminlte-input
            type="text"
            id="name"
            name="name"
            label="Name"
            placeholder="Activity name..."
            value="{{ old('name', $activity?->name ?? '') }}"
            required
          />

          <x-adminlte-select
            id="type_id"
            name="type_id"
            label="Type"
            placeholder="Select type..."
            required
          >
            @foreach ($types as $type)
              <option value="{{ $type->id }}" {{ old('type_id', $activity?->type_id ?? '') == $type->id ? 'selected' : '' }}>
                {{ $type->type }}
              </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select
            id="status"
            name="status"
            label="Status"
            placeholder="Select status..."
            required
          >
            @foreach ($statuses as $status)
              <option value="{{ $status }}" {{ old('status', $activity?->status ?? '') == $status ? 'selected' : '' }}>
                {{ $status }}
              </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select
              id="priority"
              name="priority"
              label="Priority"
              placeholder="Select priority..."
              required
          >
            @foreach ($priorities as $priority)
              <option value="{{ $priority }}" {{ old('priority', $activity?->priority ?? '') == $priority ? 'selected' : '' }}>
                {{ $priority }}
              </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select
            id="owner_id"
            name="owner_id"
            label="Owner"
            placeholder="Select owner..."
            required
          >
            @foreach ($owners as $owner)
              <option value="{{ $owner->id }}" {{ old('owner_id', $activity?->owner_id ?? Auth::user()->id) == $owner->id ? 'selected' : '' }}>
                {{ $owner->name }}
              </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select2
              id="client_id"
              name="client_id"
              label="Client"
              placeholder="Select client..."
              required
          >
            @foreach ($clients as $client)
              <option value="{{ $client->id }}" {{ old('client_id', $activity?->client_id ?? '') == $client->id ? 'selected' : '' }}>
                {{ $client->name }}
              </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select
            id="contact_id"
            name="contact_id"
            label="Contact"
            placeholder="Select contact..."
            required
          >
            @foreach ($contacts as $contact)
              <option value="{{ $contact->id }}" {{ old('contact_id', $activity?->contact_id ?? '') == $contact->id ? 'selected' : '' }}>
                {{ $contact->full_name }}
              </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select2
            id="opportunity_id"
            name="opportunity_id"
            label="Opportunity"
            placeholder="Select opportunity..."
          >
          @foreach ($oportunities as $opportunity)
              <option value="{{ $opportunity->id }}" {{ old('opportunity_id', $activity?->opportunity_id ?? '') == $opportunity->id ? 'selected' : '' }}>
                  {{ $opportunity->name }}
              </option>
          @endforeach
          </x-adminlte-select>

        </div>
      </div>
    </div>
    {{-- Column 1 --}}

    {{-- Column 2 --}}
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card card-outline card-primary">
          <div class="card-body">

            <x-adminlte-input
              type="text"
              id="description"
              name="description"
              label="Description"
              placeholder="Description..."
              value="{{ old('description', $activity?->description ?? '') }}"
              required
            />

            <x-adminlte-input
              type="datetime-local"
              id="scheduled_date"
              name="scheduled_date"
              label="Scheduled Date"
              placeholder="Scheduled date..."
              value="{{ old('scheduled_date', $activity?->scheduled_date ?? \Carbon\Carbon::now() ) }}"
              required
            />

            <x-adminlte-input
              type="datetime-local"
              id="end_date"
              name="end_date"
              label="End Date"
              placeholder="End date..."
              value="{{ old('end_date', $activity?->end_date ?? \Carbon\Carbon::now()->addSeconds(60) ) }}"
              required
            />

            <x-adminlte-textarea
              id="follow_up_notes"
              name="follow_up_notes"
              label="Notes"
              placeholder="Notes..."
              rows="10"
            >{!! old('follow_up_notes', $activity?->follow_up_notes ?? '') !!}</x-adminlte-textarea>

          </div>
      </div>
    </div>
    {{-- Column 2 --}}

  </div>
</form>

@isset($activity)
<form id="completeForm" action="{{ route('activity.completed', $activity) }}" method="POST">
  @csrf
</form>
@endisset
@stop

{{-- Extras --}}

@push('css')

@endpush


@push('js')
  @vite(['resources/js/s2Location.js', 'resources/js/s2crm.js'])
  @if($activity && $activity->completed == 0)
  <script>
    const btnComplete = document.getElementById('btnComplete');
    const completeForm = document.getElementById('completeForm');
    btnComplete.addEventListener('click', () => {
      completeForm.submit();
    });
  </script>
  @endif
  @if ($activity && $activity->completed == 1)
  <script>
    const formActivity = document.getElementById('formActivity');
    formActivity.querySelectorAll('input, select, textarea, button[type="submit"]').forEach( el => {
      el.setAttribute('disabled', true);
    });
  </script>
  @endif
@endpush

