@extends('layouts.app')

{{-- Customize layout sections --}}

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)

@section('title', isset($opportunity) ? 'Edit Opportunity' : 'New Opportunity')
@section('content_header_title', 'Opportunity')
@section('content_header_subtitle', isset($opportunity) ? 'Edit Opportunity' : 'New Opportunity')

@section('content_body')
@use('\App\Repositories\OpportunityRepository')
{{-- Form --}}
<form id="fOpportunity" action="{{ (isset($opportunity) && $opportunity?->id) ? route('opportunity.update', $opportunity) : route('opportunity.store') }}" method="POST">
  <div class="row">
    @csrf
    @if (isset($opportunity) && $opportunity?->id)
      @method('PUT')
    @endif

    <div class="col-12 mb-2">
      <div class="btn-group">
        <a href="{{ route('opportunity.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
          <i class="fas fa-angle-double-left"></i> Back
        </a>
        <x-adminlte-button
          class="btn-flat mr-1"
          type="submit"
          label="Save"
          theme="success"
          icon="fas fa-lg fa-save"
        />
        @if (isset($opportunity) && $opportunity?->id && $opportunity?->status === \App\Models\Opportunity::STATUS_OPEN)
        <x-adminlte-button
          id="btnComplete"
          label="Close"
          theme="dark"
          type="button"
          icon="fas fa-check-circle"
          data-toggle="modal"
          data-target="#modalCloseOpportunity"
        />
        @endif
      </div>
    </div>

    {{-- Column 1 --}}
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card card-outline card-primary">
        <div class="card-body">

          <x-adminlte-input
            type="text"
            id="name"
            name="name"
            label="Name"
            placeholder="Opportunity name..."
            value="{{ old('name', $opportunity?->name ?? '') }}"
            required
          />

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
          
          <x-adminlte-select
            id="client_id"
            name="client_id"
            label="Client"
            placeholder="Select client..."
            required
          >
            <option value=""></option>
            @foreach ($clients as $client)
              <option value="{{ $client->id }}" {{ old('client_id', $activity?->client_id ?? Auth::user()->id) == $client->id ? 'selected' : '' }}>
                {{ $client->name }}
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
            @foreach ($listStatus as $key => $status)
              <option value="{{ $key }}" {{ old('status', $opportunity?->status ?? '') == $key ? 'selected' : '' }}>
                {{ $status }}
              </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-select
            id="stage_id"
            name="stage_id"
            label="Stage"
            placeholder="Select stage..."
            required
          >
            @foreach ($stages as $stage)
              <option value="{{ $stage->id }}" {{ old('stage_id', $opportunity?->stage_id ?? '') == $stage->id ? 'selected' : '' }}>
                {{ $stage->stage }}
              </option>
            @endforeach
          </x-adminlte-select>

          <x-adminlte-input
            type="text"
            id="source"
            name="source"
            label="Source"
            placeholder="Add source..."
            value="{{ old('source', $opportunity?->source ?? '') }}"
          />

        </div>
      </div>
    </div>
    {{-- Column 1 --}}

    {{-- Column 2 --}}
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="card card-outline card-primary">
        <div class="card-body">

          <x-adminlte-input
            type="date"
            id="created_date"
            name="created_date"
            label="Created"
            placeholder="Select date..."
            value="{{ old('created_date', $opportunity?->created_date ?? '' ) }}"
            required
          />

          <x-adminlte-input
            type="date"
            id="estimated_close_date"
            name="estimated_close_date"
            label="Estimated Close Date"
            placeholder="Select date..."
            value="{{ old('estimated_close_date', $opportunity?->estimated_close_date ?? '' ) }}"
          />

          <x-adminlte-input
            type="date"
            id="actual_close_date"
            name="actual_close_date"
            label="Actual Close Date"
            placeholder="Select date..."
            value="{{ old('actual_close_date', $opportunity?->actual_close_date ?? '' ) }}"
          />

          <x-adminlte-input
            type="number"
            step="0.01"
            min="0"
            id="estimated_value"
            name="estimated_value"
            label="Estimated Value"
            placeholder="Add value..."
            value="{{ old('estimated_value', $opportunity?->estimated_value ?? '') }}"
            required
          />

          <x-adminlte-input
            type="text"
            id="success_probability"
            name="success_probability"
            label="Success Probability (%)"
            value="{{ old('success_probability', $opportunity?->success_probability ?? '') }}"
            disabled
          />

          <x-adminlte-input
            type="text"
            id="weighted_value"
            name="weighted_value"
            label="Weighted Value"
            value="{{ old('weighted_value', $opportunity?->weighted_value ?? '') }}"
            disabled
          />

        </div>
      </div>
    </div>
    {{-- Column 2 --}}

  </div>
</form>
{{-- Form --}}

{{-- Modal --}}
<x-adminlte-modal
    id="modalCloseOpportunity"
    title="Close Opportunity"
    theme="info"
    icon="fas fa-check-circle"
    size='md'
>
  <form action="" method="POST">
    @csrf

    <x-adminlte-select
      id="final_status"
      name="final_status"
      label="Final Status"
      required
    >
      <option value="{{ OpportunityRepository::STATUS_CLOSED_WON }}">
        {{ $listStatus[OpportunityRepository::STATUS_CLOSED_WON] }}
      </option>
      <option value="{{ OpportunityRepository::STATUS_CLOSED_LOST }}">
        {{ $listStatus[OpportunityRepository::STATUS_CLOSED_LOST] }}
      </option>
    </x-adminlte-select>

    <x-slot name="footerSlot" class="mr-auto">
      <x-adminlte-button
        type="submit"
        theme="success"
        label="Save"
        icon="fas fa-save"
      />
      <x-adminlte-button
        theme="secondary"
        label="Cancel"
        icon="fas fa-times"
        data-dismiss="modal"
      />
    </x-slot>

  </form>
</x-adminlte-modal>
{{-- Modal --}}
@stop

{{-- Extras --}}

@push('css')

@endpush

@push('js')
  @if ( isset($opportunity?->status) && $opportunity?->status !== OpportunityRepository::STATUS_OPEN )
  <script>
    const formOpportunity = document.getElementById('fOpportunity');
    formOpportunity.querySelectorAll('input, select, textarea, button[type="submit"]').forEach( el => {
      el.setAttribute('disabled', true);
    });
  </script>
  @endif
@endpush
