<?php

namespace App\Http\Controllers;

use App\Jobs\ResetPasswordJob;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{

    public $perPage = 9;


    public function index()
    {
        return view('users.index');
    }

    public function locker()
    {
        return view('users.lockscreen');
    }



    public function getUsers()
    {

        return User::withTrashed()->with('roles')->paginate($this->perPage);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'roles_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('ips2020.'),
        ]);

        $user->roles()->attach($request->roles_id);

        if ($request->send) {
            $delay = now()->addSeconds(5);
            ResetPasswordJob::dispatch($user)->delay($delay);
        }

        return $this->show($user->id);
    }

    
    
    public function update(Request $request , $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,'.$id,
            'telefono' => 'nullable|digits:10|numeric',
        ]);
        
        

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->updated_at = now();
        $user->save();
        //$user->syncRoles($request->roles_id)
        foreach ($request->roles_id as $role_id) {
            if (!empty($role_id)) {
                $role = Role::find($role_id);
                $user->syncRoles($role);
            }
        }
        
        return $user;

    }


    public function desbloquear($id)
    {

        $user = User::withTrashed()->with('roles')->where('id', $id)->first();
        $user->restore();
        return $user;
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $hasAuth = Auth::check();
        if (!$hasAuth) {
            $msj = 'Usuario ' . $user->user . 'bloqueado';
            $isValid = true;
            $user->delete();
        } else {
            $isValid = false;
            $msj = 'No es posible bloquear al usuario actualmente autenticado';
        }

        return response()->json(['isValid' => $isValid, 'msj' => $msj]);
    }


    public function search($search)
    {
        return User::withTrashed()
            ->with('roles')
            ->where('name', 'LIKE', "%" . $search . "%")
            ->paginate($this->perPage);
    }


    public function show($id)
    {
        return User::with('roles')->where('id', $id)->first();
    }


    public function paginado($perPage)
    {
        $this->perPage = $perPage;
        return $this->getUsers();
    }



    public function filter($filter)
    {
        return User::filterRole($filter)->with('roles')->paginate($this->perPage);
    }


    public function profile()
    {
        $id = Auth::id();
        $auth = User::find($id);
        $auth->hasAllRoles(Role::all());
        return view('users.profile' , [
            'auth' => $auth,
        ]);
    }
}
