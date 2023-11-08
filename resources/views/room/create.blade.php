@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Tambah Data Kamar</h2>
        </div>
        <div class="card border-0 shadow rounded col-md-8">
            <form method="post" action="{{ route('room-store') }}">
                @csrf
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nomor Kamar</label>
                        <input name="nomorkamar" value="{{ old('nomorkamar') }}" class="form-control @error('nomorkamar') is-invalid @enderror">
                    </div>
                    <div class="mb-3">
                        <label>Tipe Kamar</label>
                        <select name="tipekamar" class="form-select @error('tipekamar') is-invalid @enderror">
                            <option value="regular">Regular</option>
                            <option value="executive">Executive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="kosong">Kosong</option>
                            <option value="dipesan">Dipesan</option>
                            <option value="diperbaiki">Diperbaiki</option>
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
