<?php

namespace App\Http\Controllers;

use App\Models\Reservations;
use App\Models\Rooms;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index(){
        $data = Reservations::all();
        return view('reservation.index', compact('data'));
    }

    public function search(Request $request){
        $data = Reservations::join('rooms', 'rooms.id', '=', 'reservations.idkamar')
            ->where('rooms.nomorkamar', '=', "$request->var")
            ->get();
        return view('reservation.index', compact('data'));
    }

    public function create(){
        $kamar = Rooms::where('status', '=', 'kosong')->get();
        return view('reservation.create', compact('kamar'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'nokamar' => 'required',
            'nmpenyewa' => 'required',
            'jenisidentitas' => 'required',
            'noidentitas' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
        ]);

        $checkin = date('Y-m-d H:i:s', strtotime($request->checkin . ' 13:00:00'));
        $checkout = date('Y-m-d H:i:s', strtotime($request->checkout . ' 12:00:00'));

        Reservations::create([
            'idkamar' => $request->nokamar,
            'nmpenyewa' => $request->nmpenyewa,
            'jenisidentitas' => $request->jenisidentitas,
            'noidentitas' => $request->noidentitas,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'idstaff' => user_id()
        ]);

        $kamar = Rooms::findOrFail($request->nokamar);
        $kamar->update([
            'status' => 'dipesan'
        ]);

        return redirect()->route('reservation');
    }

    public function edit($id){
        $data = Reservations::findOrFail($id);
        $kamar = Rooms::where('status', '=', 'kosong')->get();

        $cekin = explode(' ', $data->checkin);
        $cekin = $cekin[0];

        $cekot = explode(' ', $data->checkout);
        $cekot = $cekot[0];

        return view('reservation.edit', compact('data', 'kamar', 'cekin', 'cekot'));
    }

    public function update(Request $request, $id){
        $reserv = Reservations::findOrFail($id);

        $this->validate($request, [
            'nmpenyewa' => 'required',
            'jenisidentitas' => 'required',
            'noidentitas' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
        ]);

        $checkin = date('Y-m-d H:i:s', strtotime($request->checkin . ' 13:00:00'));
        $checkout = date('Y-m-d H:i:s', strtotime($request->checkout . ' 12:00:00'));

        $nokamar = $request->nokamar;
        if (is_null($request->nokamar)){
            $nokamar = $reserv->idkamar;
        }

        $reserv->update([
            'idkamar' => $nokamar,
            'nmpenyewa' => $request->nmpenyewa,
            'jenisidentitas' => $request->jenisidentitas,
            'noidentitas' => $request->noidentitas,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'idstaff' => user_id()
        ]);

        return redirect()->route('reservation');
    }

    public function delete($id){
        $reserv = Reservations::find($id);

        $room = Rooms::findOrFail($reserv->idkamar);
        $room->update([
            'status' => 'kosong'
        ]);
        $reserv->delete();

        return redirect()->route('reservation');
    }
}
