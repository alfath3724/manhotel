<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index(){
        $data = Rooms::all();
        return view('room.index', compact('data'));
    }

    public function search(Request $request){
        $data = Rooms::where('nomorkamar', 'like', "%$request->var%")->get();
        return view('room.index', compact('data'));

    }

    public function create(){
        return view('room.create');
    }

    public function store(Request $request){
        $room = new Rooms();

        $this->validate($request, [
            'nomorkamar' => 'required|unique:rooms,nomorkamar',
            'tipekamar' => 'required',
            'status' => 'required',
        ]);

        Rooms::create([
            'nomorkamar' => $request->nomorkamar,
            'tipekamar' => $request->tipekamar,
            'status' => $request->status
        ]);

        return redirect()->route('room');
    }

    public function edit($id){
        $data = Rooms::findOrFail($id);
        return view('room.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $room = Rooms::findOrFail($id);

        $this->validate($request, [
            'tipekamar' => 'required',
            'status' => 'required',
        ]);

        $room->update([
            'tipekamar' => $request->tipekamar,
            'status' => $request->status
        ]);

        return redirect()->route('room');
    }

    public function delete($id){
        $room = Rooms::find($id);
        $room->delete();

        return redirect()->route('room');
    }
}
