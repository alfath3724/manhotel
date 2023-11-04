@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Data Kamar</h2>
            @if(isAdmin())
            <a href="{{ route('room-create') }}" class="btn btn-sm btn-success">Tambah Data</a>
            @endif
        </div>
        <div>
            <form class="form" method="get" action="{{ route('room-search') }}">
                <div class="form-group w-auto mb-3">
                    <label for="search" class="d-block mr-2">Cari Data</label>
                    <input type="text" name="var" class="form-control d-inline mb-1" id="search" placeholder="Masukkan nomor kamar">
                    <button type="submit" class="btn btn-sm btn-primary mb-1">Cari</button>
                    <a href="{{ route('room') }}" class="btn btn-sm btn-secondary mb-1">Reload</a>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Nomor Kamar</th>
            <th>Tipe Kamar</th>
            <th>Status</th>
            <th>Opsi</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($data as $d)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $d->nomorkamar }}</td>
                <td>{{ ucwords($d->tipekamar) }}</td>
                <td>
                    <span class="badge bg-{{ render_badge($d->status) }}">{{ ucwords($d->status) }}</span>
                </td>
                <td>
                    @if(isAdmin())
                    <a href="{{ route('room-edit', $d->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $d->id }}').submit();" class="btn btn-sm btn-danger">Hapus</a>
                    <form id="delete-form-{{ $d->id }}" action="{{ route('room-delete', $d->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin?')">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
