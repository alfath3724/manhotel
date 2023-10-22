@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Data User</h2>
        </div>
        <div>
            <form class="form" method="get" action="{{ route('user-search') }}">
                <div class="form-group w-auto mb-3">
                    <label for="search" class="d-block mr-2">Cari Data</label>
                    <input type="text" name="var" class="form-control d-inline mb-1" id="search" placeholder="Masukkan nama">
                    <button type="submit" class="btn btn-sm btn-primary mb-1">Cari</button>
                    <a href="{{ route('user') }}" class="btn btn-sm btn-secondary mb-1">Reload</a>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Opsi</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($data as $d)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->email }}</td>
            @if(isset($d->roles))
                <td>{{ $d->roles->nmrole }}</td>
            @else
                <td>-</td>
            @endif
            <td>
                <a href="{{ route('user-edit', $d->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $d->id }}').submit();" class="btn btn-sm btn-danger">Hapus</a>
                <form id="delete-form-{{ $d->id }}" action="{{ route('user-delete', $d->id) }}" method="POST" class="d-none" onsubmit="return confirm('Apakah anda yakin?')">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
