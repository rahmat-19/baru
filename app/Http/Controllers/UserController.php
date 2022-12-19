<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Luilliarcec\LaravelUsernameGenerator\Facades\Username;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
    /* ==================================== INDEX ====================================== */
    public function waspangIndex()
    {
        return view('admin.waspang.index', [
            'title' => 'Users',
            'datas' => User::where('is_admin', 'waspang')->get()
        ]);
    }
    public function asmenIndex()
    {
        return view('admin.asmen.index', [
            'title' => 'Users',
            'datas' => User::where('is_admin', 'asmen')->get()
        ]);
    }




    /* ==================================== STORE ====================================== */
    public function asmenStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'unique:users',
            'password' => 'required|min:6'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['is_admin'] = 'asmen';


        $valid = Auth::user()->create($validatedData);
        return redirect(Route('asmen.index'));
    }

    public function waspangStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'unique:users',
            'password' => 'required|min:6'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);


        $valid = Auth::user()->create($validatedData);
        return redirect(Route('waspang.index'));
    }

    /* ==================================== DESTROY ====================================== */
    public function asmenDestroy(User $user)
    {
        $valid = User::destroy($user->id);
        return redirect(Route('asmen.index'));
    }

    public function waspangDestroy(User $user)
    {
        $valid = User::destroy($user->id);
        return redirect(Route('waspang.index'));
    }
}
