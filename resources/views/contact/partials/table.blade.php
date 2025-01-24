@php
$heads = ['ID', 'Name', 'Client', 'Gender', 'Job Title', 'Department', 'Email', 'Phone', 'Country', 'Actions'];
@endphp

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('contact.create') }}" class="btn btn-outline-light bg-info">
                <i class="fas fa-plus"></i> New Contact
            </a>
        </h3>
    </div>
    <div class="card-body">

        <x-adminlte-datatable id="table-contacts" :heads="$heads" head-theme="dark" hoverable>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->full_name }}</td>
                    <td>{{ $contact->client->name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->job_title->job_title }}</td>
                    <td>{{ $contact->department->department }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->country->name }}</td>
                    <td width="20">
                        <div class="btn-group">
                            <a href="{{ route('contact.edit', $contact) }}" class="btn btn-outline-info mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('contact.destroy', $contact) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger mr-2 btnDel">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                            
                            <a href="{{ route('contact.show', $contact) }}" class="btn btn-outline-secondary">
                                <i class="far fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>

    </div>
</div>