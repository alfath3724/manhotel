@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Edit Data Role <i><u>{{ $data->nmrole }}</u></i></h2>
        </div>
        <div class="card border-0 shadow rounded col-md-8">
            <form method="post" action="{{ route('role-update', $data->id) }}">
                @csrf
                @method('PUT')
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nama Role</label>
                        <input name="namarole" value="{{ old('namarole', $data->nmrole) }}" class="form-control @error('namarole') is-invalid @enderror">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-end" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
