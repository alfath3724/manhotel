@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Edit Data Kamar <i><u>{{ $data->nomorkamar }}</u></i></h2>
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
                        <input name="nomorkamar" value="{{ old('nomorkamar', $data->nomorkamar) }}" class="form-control @error('nomorkamar') is-invalid @enderror" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Tipe Kamar</label>
                        <select name="tipekamar" class="form-select @error('tipekamar') is-invalid @enderror">
                            <option value="regular" @if($data->tipekamar == 'regular') selected @endif>Regular</option>
                            <option value="executive" @if($data->tipekamar == 'executive') selected @endif>Executive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="kosong" @if($data->status == 'kosong') selected @endif>Kosong</option>
                            <option value="dipesan" @if($data->status == 'dipesan') selected @endif>Dipesan</option>
                            <option value="diperbaiki" @if($data->status == 'diperbaiki') selected @endif>Diperbaiki</option>
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
