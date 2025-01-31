@extends('layouts.app')

@section('title', 'User Details - ' . $user->name)
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Details: ' . $user->name)

@section('content_body')
<div class="row">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-2">
    <div class="btn-group">
      <a href="{{ route('user.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
        <i class="fas fa-angle-double-left"></i> Back
      </a>
      @if ($user->id !== 1)
      <a href="{{ route('user.edit', $user) }}" class="btn btn-outline-light bg-info px-4">
        <i class="fas fa-edit"></i> Edit
      </a>
      @endif
    </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
    
    <x-adminlte-profile-widget
      name="{{ $user?->name ?? 'User' }}"
      desc="{{ $user?->email ?? '' }}"
      theme="lightblue"
      layout-type="classic"
      class="bg-white"
    >

      <x-adminlte-profile-col-item
        icon="fas fa-user-tie fa-2x text-lightblue"
        title="Clients"
        text="{{ $detailsUser['clients'] }}"
        url="{{ route('client.index', ['owner' => $user->id]) }}"
        badge="gray-dark"
        size=4
      />

      <x-adminlte-profile-col-item
        icon="fas fa-clipboard-list fa-2x text-lightblue"
        title="Activities"
        text="{{ $detailsUser['activities'] }}"
        url="{{ route('activity.index', ['owner' => $user->id]) }}"
        badge="gray-dark"
        size=4
      />

      <x-adminlte-profile-col-item
        icon="fas fa-hand-holding-usd fa-2x text-lightblue"
        title="Opportunities"
        text="{{ $detailsUser['opportunities'] }}"
        url="{{ route('opportunity.index', ['owner' => $user->id]) }}"
        badge="gray-dark"
        size=4
      />

    </x-adminlte-profile-widget>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
    <div class="card card-info card-outline">
        <div class="card-body box-profile">
          <h3 class="profile-username text-info text-center">Change Password</h3>

          <form action="{{ route('user.change_password', $user) }}" method="POST">
            @csrf

            <x-adminlte-input
              type="password"
              id="password"
              name="password"
              label="Password"
              placeholder="Your password..."
              value="{{ old('password' ?? '') }}"
            >
              <x-slot name="appendSlot">
                <x-adminlte-button
                  theme="outline-secondary"
                  icon="fas fa-eye"
                  class="btn-show-pass"
                />
              </x-slot>
            </x-adminlte-input>

            <x-adminlte-input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              label="Confirm Password"
              placeholder="Repeat password..."
              value="{{ old('password_confirmation' ?? '') }}"
            >
              <x-slot name="appendSlot">
                <x-adminlte-button
                  theme="outline-secondary"
                  icon="fas fa-eye"
                  class="btn-show-pass"
                />
              </x-slot>
            </x-adminlte-input>

            <div class="btn-group float-right">
              <x-adminlte-button
                class="btn-flat"
                type="submit"
                label="Save"
                theme="success"
                icon="fas fa-lg fa-save"
              />
            </div>

          </form>
        </div>
    </div>
  </div>

</div>
@stop

@push('css')

@endpush

{{-- Push extra scripts --}}

@push('js')
<script>
  const btnShowPass = document.querySelectorAll('.btn-show-pass');
  btnShowPass.forEach( btn => {
    btn.addEventListener( 'click', event => {
      const inputPassword = btn.closest('.input-group').querySelector('input');
      inputPassword.type = inputPassword.type === 'password' ? 'text' : 'password';
      btn.innerHTML = inputPassword.type === 'password'
          ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    })
  });
</script>
@endpush