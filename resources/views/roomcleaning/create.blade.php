@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Tambah Data Kebersihan Kamar</h2>
        </div>
        <div class="card border-0 shadow rounded col-md-8">
            <form method="post" action="{{ route('roomcleaning-store') }}">
                @csrf
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nomor Kamar</label>
                        <select name="idkamar" class="form-select @error('idkamar') is-invalid @enderror">
                            @foreach($kamar as $k)
                                <option value="{{ $k->id }}">{{ $k->nomorkamar }} - {{ ucwords($k->tipekamar) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Petugas</label>
                        <select name="idstaff" class="form-select @error('idstaff') is-invalid @enderror">
                            @foreach($petugas as $p)
                                <option value="{{ $p->id }}">{{ ucwords($p->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-end" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
