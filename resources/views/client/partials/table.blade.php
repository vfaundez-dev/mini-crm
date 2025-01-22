@php
$heads = ['ID', 'Name', 'Status', 'Type', 'Industry', 'Owner', 'Country', 'Email', 'Actions'];
@endphp

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      <a href="{{ route('client.create') }}" class="btn btn-outline-light bg-info">
        <i class="fas fa-plus"></i> New Client
      </a>
    </h3>
  </div>
  <div class="card-body">
    <x-adminlte-datatable id="table-clients" :heads="$heads" head-theme="dark" hoverable>
      @foreach ($clients as $client)
        <tr>
          <td>{{ $client->id }}</td>
          <td>{{ $client->name }}</td>
          <td>{{ $client->status->status }}</td>
          <td>{{ $client->type->name }}</td>
          <td>{{ $client->industry->name }}</td>
          <td>{{ $client->owner->name ?? 'N/A' }}</td>
          <td>{{ $client->country->name ?? 'N/A' }}</td>
          <td>{{ $client->email }}</td>
          <td width="20">
            <div class="btn-group">

              <a href="{{ route('client.edit', $client) }}" class="btn btn-outline-info mr-2">
                <i class="fas fa-edit"></i>
              </a>

              <form action="{{ route('client.destroy', $client) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger mr-2 btnDel">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
                
              <a href="{{ route('client.show', $client) }}" class="btn btn-outline-secondary">
                <i class="far fa-eye"></i>
              </a>
              
            </div>
          </td>
        </tr>
      @endforeach
    </x-adminlte-datatable>
  </div>
</div>