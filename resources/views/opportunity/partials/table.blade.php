@php
$heads = ['ID', 'Name', 'Owner', 'Client', 'Status', 'Stage', 'Created', 'Success Probability', 'Actions'];
@endphp

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      <a href="{{ route('opportunity.create') }}" class="btn btn-outline-light bg-info">
        <i class="fas fa-plus"></i> New Opportunity
      </a>
    </h3>
  </div>
  <div class="card-body">
    <x-adminlte-datatable id="table-opportunities" :heads="$heads" head-theme="dark" hoverable>
      @foreach ($opportunities as $opportunity)
        <tr>
          <td>{{ $opportunity->id }}</td>
          <td>{{ $opportunity->name }}</td>
          <td>{{ $opportunity->owner->name }}</td>
          <td>{{ $opportunity->client->name }}</td>
          <td>{{ $opportunity->listStatus()[$opportunity->status] }}</td>
          <td>{{ $opportunity->stage->stage }}</td>
          <td>{{ $opportunity->created_date }}</td>
          <td>{{ $opportunity->success_probability }}%</td>
          <td width="20">
            <div class="btn-group">
              @if ( intval($opportunity->status) == 0)
              <a href="{{ route('opportunity.edit', $opportunity) }}" class="btn btn-outline-info mr-2">
                <i class="fas fa-edit"></i>
              </a>
              @endif
              <form action="{{ route('opportunity.destroy', $opportunity) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger mr-2 btnDel">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
              <a href="{{ route('opportunity.show', $opportunity) }}" class="btn btn-outline-secondary">
                <i class="far fa-eye"></i>
              </a>
            </div>
          </td>
        </tr>
      @endforeach
    </x-adminlte-datatable>
  </div>
</div>