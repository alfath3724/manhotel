<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $data = User::all();
        return view('user.index', compact('data'));
    }

    public function edit($id){
        $data = User::find($id);
        return view('user.edit', compact('data'));
    }

    public function search(Request $request){
        $data = User::where('name', 'like', "%$request->var%")->get();
        return view('user.index', compact('data'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);

        $this->validate($request, [
            'role' => 'required',
        ]);

        $user->update([
           'idrole' => $request['role']
        ]);

        if ($user){
            return redirect()
                ->route('user');
        }else{
            return redirect()
                ->back()
                ->with([
                    'error' => 'Terjadi kesalahan'
                ]);
        }
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user');
    }
}
