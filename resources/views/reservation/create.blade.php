@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h2>Buat Reservasi Kamar</h2>
        </div>
        <div class="card border-0 shadow rounded col-md-8">
            <form method="post" action="{{ route('reservation-store') }}">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nomor Kamar</label>
                        <select class="form-select @error('nokamar') is-invalid @enderror" name="nokamar">
                            @foreach($kamar as $k)
                            <option value="{{ $k->id }}">{{ $k->nomorkamar }} - {{ ucwords($k->tipekamar) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Nama Penyewa</label>
                        <input name="nmpenyewa" value="{{ old('nmpenyewa') }}" class="form-control @error('nmpenyewa') is-invalid @enderror">
                    </div>
                    <div class="mb-3">
                        <label>Jenis Identitas</label>
                        <select class="form-select @error('jenisidentitas') is-invalid @enderror" name="jenisidentitas">
                            <option value="ktp">KTP</option>
                            <option value="passport">Passport</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>No Identitas</label>
                        <input name="noidentitas" value="{{ old('noidentitas') }}" class="form-control @error('noidentitas') is-invalid @enderror">
                    </div>
                    <div class="mb-3">
                        <label>Check in</label>
                        <input name="checkin" id="checkin" type="date" value="{{ old('checkin') }}" onblur="gantitanggal()" class="form-control @error('checkin') is-invalid @enderror">
                    </div>
                    <div class="mb-3">
                        <label>Check out</label>
                        <input name="checkout" id="checkout" type="date" value="{{ old('checkout') }}" class="form-control @error('checkin') is-invalid @enderror">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-end" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            var today = new Date();
            var dd = today.getDate();
            var nd = today.getDate() + 1;
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd
            }

            if (nd < 10) {
                nd = '0' + nd
            }

            if (mm < 10) {
                mm = '0' + mm
            }

            today = yyyy + '-' + mm + '-' + dd;
            var nextday = yyyy + '-' + mm + '-' + nd;
            document.getElementById("checkin").setAttribute("min", today);
            document.getElementById("checkout").setAttribute("min", nextday);
        })

        Date.prototype.yyyymmdd = function() {
            var mm = this.getMonth() + 1;
            var dd = this.getDate();

            return [
                this.getFullYear(),
                (mm>9 ? '' : '0') + mm,
                (dd>9 ? '' : '0') + dd
            ].join('-');
        };

        function gantitanggal() {
            $('#checkout').val('');
            let valin = document.getElementById("checkin").value;
            valin = valin.split("-");
            let saiki = valin[2];
            let minToDate = new Date();
            minToDate.setDate(parseInt(saiki) + 1);
            let kir = minToDate.yyyymmdd();
            document.getElementById("checkout").setAttribute("min", kir);
        }
    </script>
@endsection
