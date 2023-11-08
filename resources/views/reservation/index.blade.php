@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Data Reservasi</h2>
            <a href="{{ route('reservation-create') }}" class="btn btn-sm btn-success">Tambah Data</a>
        </div>
        <div>
            <form class="form" method="get" action="{{ route('reservation-search') }}">
                <div class="form-group w-auto mb-3">
                    <label for="search" class="d-block mr-2">Cari Data</label>
                    <input type="text" name="var" class="form-control d-inline mb-1" id="search"
                           placeholder="Masukkan nomor kamar">
                    <button type="submit" class="btn btn-sm btn-primary mb-1">Cari</button>
                    <a href="{{ route('reservation') }}" class="btn btn-sm btn-secondary mb-1">Reload</a>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>No Kamar</th>
            <th>Nama Penyewa</th>
            <th>Identitas</th>
            <th>Petugas</th>
            <th>Check In</th>
            <th>Checkout</th>
            <th>Opsi</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($data as $d)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $d->kamar->nomorkamar }}</td>
                <td>{{ $d->nmpenyewa }}</td>
                <td>{{ strtoupper($d->jenisidentitas) }} - {{ $d->noidentitas }}</td>
                <td>{{ $d->petugas->name }}</td>
                <td>{{ date('d M Y H:i', strtotime($d->checkin)) }}</td>
                <td> @if($d->checkout) {{ date('d M Y H:i', strtotime($d->checkout)) }} @else - @endif</td>
                <td>
                    <a href="{{ route('reservation-edit', $d->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('delete-form-{{ $d->id }}').submit();"
                       class="btn btn-sm btn-danger">Hapus</a>
                    <form id="delete-form-{{ $d->id }}" action="{{ route('reservation-delete', $d->id) }}" method="POST"
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
