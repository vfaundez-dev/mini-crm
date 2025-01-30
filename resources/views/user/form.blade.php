@extends('layouts.app')

@section('title', isset($user) ? 'Edit User' : 'New User')
@section('content_header_title', 'Users')
@section('content_header_subtitle', isset($user) ? 'Edit User' : 'New User')

@section('content_body')
<form action="{{ (isset($user) && $user?->id) ? route('user.update', $user) : route('user.store') }}" method="POST">
  <div class="row">
    @csrf
    @if (isset($user) && $user?->id)
      @method('PUT')
    @endif

    {{-- Actions --}}
    <div class="col-12 mb-2">
      <div class="btn-group">
        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary bg-secondary mr-1">
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
            id="name"
            name="name"
            label="Name"
            placeholder="Your user name..."
            value="{{ old('name', $user?->name ?? '') }}"
            required
          />

          <x-adminlte-input
            type="email"
            id="email"
            name="email"
            label="Email"
            placeholder="Your user email..."
            value="{{ old('email', $user?->email ?? '') }}"
            required
          />

          <x-adminlte-input
            type="password"
            id="password"
            name="password"
            label="Password"
            placeholder="Your password..."
            value="{{ old('password' ?? '') }}"
            required
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
            id="repeat_password"
            name="repeat_password"
            label="Repeat Password"
            placeholder="Repeat password..."
            value="{{ old('repeat_password' ?? '') }}"
            required
          >
            <x-slot name="appendSlot">
                <x-adminlte-button
                  theme="outline-secondary"
                  icon="fas fa-eye"
                  class="btn-show-pass"
                />
            </x-slot>
          </x-adminlte-input>

        </div>
      </div>
    </div>
    {{-- Column1 --}}

  </div>
</form>
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