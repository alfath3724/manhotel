<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(){
        $data = Roles::all();
        return view('role.index', compact('data'));
    }

    public function search(Request $request){
        $data = Roles::where('nmrole', 'like', "%$request->var%")->get();
        return view('role.index', compact('data'));
    }

    public function create(){
        return view('role.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'namarole' => 'required',
        ]);

        Roles::create([
            'nmrole' => $request->namarole,
        ]);

        return redirect()->route('role');
    }

    public function edit($id){
        $data = Roles::findOrFail($id);
        return view('role.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $role = Roles::findOrFail($id);

        $this->validate($request, [
            'namarole' => 'required',
        ]);

        $role->update([
            'nmrole' => $request->namarole,
        ]);

        return redirect()->route('role');
    }

    public function delete($id){
        $role = Roles::find($id);
        $role->delete();

        return redirect()->route('role');
    }
}
