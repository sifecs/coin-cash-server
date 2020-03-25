<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.index',['users'=> $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' =>'required|phone:US,BE,KG,RU',
            'email' => 'nullable|email|unique:users',
            'password' => 'required',
            'avatar' => 'nullable|image',
            'balans' => 'nullable|numeric',
            'status' => 'nullable|boolean',
            'is_admin' => 'nullable|boolean',
        ]);
        $user = User::add($request->all());
        $user->generateToken();
        $user->uploadAvatar($request->file('avatar'));

        if ($request->get('status') != null) {
            $user->ban();
        }
        if ($request->get('is_admin') != null) {
            $user->makeAdmin();
        }
        $user->setBalans($request->get('balans'));
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit',['user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'nullable',
            'phone' => ['required', 'phone:US,BE,KG,RU', Rule::unique('users')->ignore($user->id),],
            'avatar' => 'nullable|image',
            'email' => ['nullable','email',Rule::unique('users')->ignore($user->id),],
            'balans' => 'nullable|numeric',
            'status' => 'nullable|boolean',
            'is_admin' => 'nullable|boolean',
        ]);

        $user->edit($request->all());
        $user->uploadAvatar($request->file('avatar'));

        if ($request->get('status') != null) {
            $user->ban();
        } else {
            $user->unban();
        }
        if ($request->get('is_admin') != null) {
            $user->makeAdmin();
        } else {
            $user->makeNormal();
        }
        $user->setBalans($request->get('balans'));

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::find($id)->remove();
        return redirect()->route('users.index');
    }
}
