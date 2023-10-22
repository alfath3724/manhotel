@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Data Role</h2>
            <a href="{{ route('role-create') }}" class="btn btn-sm btn-success">Tambah Data</a>
        </div>
        <div>
            <form class="form" method="get" action="{{ route('role-search') }}">
                <div class="form-group w-auto mb-3">
                    <label for="search" class="d-block mr-2">Cari Data</label>
                    <input type="text" name="var" class="form-control d-inline mb-1" id="search"
                           placeholder="Masukkan nama role">
                    <button type="submit" class="btn btn-sm btn-primary mb-1">Cari</button>
                    <a href="{{ route('role') }}" class="btn btn-sm btn-secondary mb-1">Reload</a>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Role</th>
            <th>Opsi</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($data as $d)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $d->nmrole }}</td>
                <td>
                    <a href="{{ route('role-edit', $d->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $d->id }}').submit();"
                       class="btn btn-sm btn-danger">Hapus</a>
                    <form id="delete-form-{{ $d->id }}" action="{{ route('role-delete', $d->id) }}" method="POST"
                          onsubmit="return confirm('Apakah anda yakin?')">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
