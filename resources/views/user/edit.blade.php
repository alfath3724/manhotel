@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Edit Data User <i><u>{{ $data->name }}</u></i></h2>
        </div>
        <div class="card border-0 shadow rounded col-md-8">
            <form method="post" action="{{ route('user-update', $data->id) }}">
                @csrf
                @method('PUT')
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror">
                            <option></option>
                            <option value="1" @if($data->idrole == 1) selected @endif>Admin</option>
                            <option value="2" @if($data->idrole == 2) selected @endif>Staff Kebersihan</option>
                            <option value="3" @if($data->idrole == 3) selected @endif>Staff Reservasi</option>
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
