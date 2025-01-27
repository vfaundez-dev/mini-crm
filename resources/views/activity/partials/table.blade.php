@php
$heads = ['ID', 'Name', 'Type', 'Status', 'Priority', 'Scheduled Date', 'End Date', 'Owner', 'Actions'];
@endphp

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      <a href="{{ route('activity.create') }}" class="btn btn-outline-light bg-info">
        <i class="fas fa-plus"></i> New Activity
      </a>
    </h3>
  </div>
  <div class="card-body">

    <x-adminlte-datatable id="table-activities" :heads="$heads" head-theme="dark" hoverable>
        @foreach ($activities as $activity)
          <tr>
            <td>{{ $activity->id }}</td>
            <td>{{ $activity->name }}</td>
            <td>{{ $activity->type->type }}</td>
            <td>{{ $activity->status }}</td>
            <td>{{ $activity->priority }}</td>
            <td>{{ $activity->scheduled_date }}</td>
            <td>{{ $activity->end_date }}</td>
            <td>{{ $activity->owner->name }}</td>
            <td class="text-right" width="20">
              <div class="btn-group">
                @if(isset($activity) && $activity->completed == 0)
                <a href="{{ route('activity.edit', $activity) }}" class="btn btn-outline-info mr-2">
                  <i class="fas fa-edit"></i>
                </a>
                @endif
                <form action="{{ route('activity.destroy', $activity) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger mr-2 btnDel">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </form>  
                <a href="{{ route('activity.show', $activity) }}" class="btn btn-outline-secondary">
                  <i class="far fa-eye"></i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
    </x-adminlte-datatable>

  </div>
</div>