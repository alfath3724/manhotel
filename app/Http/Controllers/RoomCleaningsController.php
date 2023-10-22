<?php

namespace App\Http\Controllers;

use App\Models\RoomCleaning;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Http\Request;

class RoomCleaningsController extends Controller
{
    public function index(){
        $data = RoomCleaning::all();
        $petugas = User::where('idrole', '=', '2')->get();
        return view('roomcleaning.index', compact('data', 'petugas'));
    }

    public function search(Request $request){
        $data = RoomCleaning::join('rooms', 'rooms.id', '=', 'roomcleanings.idkamar');
        if (!empty($request->var)){
            $data = $data->where('rooms.nomorkamar', '=', "$request->var");
        }

        if (!empty($request->petugas)){
            $data = $data->where('idstaff', '=', "$request->petugas");
        }
        $data = $data->get();
        $petugas = User::where('idrole', '=', '2')->get();
        return view('roomcleaning.index', compact('data', 'petugas'));
    }

    public function create(){
        $kamar = Rooms::orderBy('nomorkamar', 'asc')
            ->whereNotIN('id', function ($query){
                $query->select('idkamar')
                    ->from('roomcleanings');
            })
            ->get();
        $petugas = User::where('idrole', '2')->get();
        return view('roomcleaning.create', compact('kamar', 'petugas'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'idkamar' => 'required',
            'idstaff' => 'required',
        ]);

        RoomCleaning::create([
            'idkamar' => $request->idkamar,
            'idstaff' => $request->idstaff,
        ]);

        return redirect()->route('roomcleaning');
    }

    public function edit($id){
        $data = RoomCleaning::findOrFail($id);
        $petugas = User::where('idrole', '2')->get();
        return view('roomcleaning.edit', compact('data', 'petugas'));
    }

    public function update(Request $request, $id){
        $room = RoomCleaning::findOrFail($id);

        $this->validate($request, [
            'tipekamar' => 'required',
            'status' => 'required',
        ]);

        $room->update([
            'tipekamar' => $request->tipekamar,
            'status' => $request->status
        ]);

        return redirect()->route('roomcleaning');
    }

    public function delete($id){
        $room = RoomCleaning::findorFail($id);
        $room->delete();

        return redirect()->route('roomcleaning');
    }

    public function cleaned($id){
        $room = RoomCleaning::findOrFail($id);

        $room->update([
            'tanggaldibersihkan' => now()
        ]);

        return redirect()->route('roomcleaning');
    }
}
