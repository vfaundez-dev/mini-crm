@php
$heads = ['ID', 'Name', 'Email', 'Actions'];
@endphp

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      <a href="{{ route('user.create') }}" class="btn btn-outline-light bg-info">
        <i class="fas fa-plus"></i> New User
      </a>
    </h3>
  </div>
  <div class="card-body">
    <x-adminlte-datatable id="table-users" :heads="$heads" head-theme="dark" hoverable>
      @foreach ($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td width="20">
            @if ($user->id !== 1)
              <div class="btn-group">
                <a href="{{ route('user.edit', $user) }}" class="btn btn-outline-info mr-2">
                  <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('user.destroy', $user) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger mr-2 btnDel">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
                <a href="{{ route('user.show', $user) }}" class="btn btn-outline-secondary">
                  <i class="far fa-eye"></i>
                </a>
              </div>
            @endif
          </td>
        </tr>
      @endforeach
    </x-adminlte-datatable>
  </div>
</div>