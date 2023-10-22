@extends('app')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2>Data Kebersihan Kamar</h2>
            @if(isAdmin())
            <a href="{{ route('roomcleaning-create') }}" class="btn btn-sm btn-success mb-3">Tambah Data</a>
            @endif
        </div>
        <div>
            <form class="form" method="get" action="{{ route('roomcleaning-search') }}">
                <div class="form-group w-auto mb-3">
                    <label for="search" class="d-block mr-2">Cari Data</label>
                    <input type="text" name="var" class="form-control d-inline mb-1" id="search" placeholder="Masukkan nomor kamar">
                    <select name="petugas" class="form-select mb-1">
                        <option value="">Petugas</option>
                        @foreach($petugas as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary mb-1">Cari</button>
                    <a href="{{ route('roomcleaning') }}" class="btn btn-sm btn-secondary mb-1">Reload</a>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Nomor Kamar</th>
            <th>Petugas</th>
            <th>Terakhir Dibersihkan</th>
            <th>Opsi</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @foreach($data as $d)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $d->kamar->nomorkamar }}</td>
                <td>{{ ucwords($d->petugas->name) }}</td>
                <td> @if ($d->tanggaldibersihkan ) {{ date('d M Y H:i', strtotime($d->tanggaldibersihkan)) }} @else - @endif</td>
                <td>
                    @if(isAdmin())
                    <a href="{{ route('roomcleaning-edit', $d->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $d->id }}').submit();" class="btn btn-sm btn-danger">Hapus</a>
                    <form id="delete-form-{{ $d->id }}" action="{{ route('roomcleaning-delete', $d->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin?')">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endif

                    @if(isStaffKebersihan())
                        @if($d->idstaff == user_id())
                            <a href="{{ route('roomcleaning-cleaned', $d->id) }}" class="btn btn-sm btn-secondary">Tandai sudah dibersihkan</a>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
