@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Edit Data Kebersihan Kamar <i><u>{{ $data->kamar->nomorkamar }}</u></i></h2>
        </div>
        <div class="card border-0 shadow rounded col-md-8">
            <form method="post" action="{{ route('room-update', $data->id) }}">
                @csrf
                @method('PUT')
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nomor Kamar</label>
                        <input class="form-control" value="{{ $data->kamar->nomorkamar }} - {{ ucwords($data->kamar->tipekamar) }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Petugas</label>
                        <select name="idstaff" class="form-select @error('idstaff') is-invalid @enderror">
                            @foreach($petugas as $p)
                                <option value="{{ $p->id }}" @if($p->id == $data->idstaff) selected @endif>{{ ucwords($p->name) }}</option>
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
