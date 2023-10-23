<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use jeremykenedy\LaravelRoles\Models\Role;
use Laravel\Jetstream\Jetstream;

class UsermanagementController extends Controller
{
    public function index(): Factory|View|Application
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }

    public function create(): Factory|View|Application
    {
        $roles = DB::table('roles')->get();
        return view('users.create', compact('roles'));
    }


    /**
     * @throws ValidationException
     */
    public function store(Request $request): Redirector|Application|RedirectResponse
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name'                  => 'required|max:255',
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:20|confirmed',
                'password_confirmation' => 'required|same:password',
                'role'                  => 'required',
            ],
            [
                'name.unique'         => trans('auth.userNameTaken'),
                'name.required'       => trans('auth.userNameRequired'),
                'email.required'      => trans('auth.emailRequired'),
                'email.email'         => trans('auth.emailInvalid'),
                'password.required'   => trans('auth.passwordRequired'),
                'password.min'        => trans('auth.PasswordMin'),
                'password.max'        => trans('auth.PasswordMax'),
                'role.required'       => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'             => strip_tags($request->input('name')),
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),

        ]);


        $user->attachRole($request->input('role'));
        $user->save();

        return redirect('users')->with('success', trans('Created'));
    }

    public function edit(User $user): Factory|View|Application
    {
        $roles = Role::all();

        foreach ($user->roles as $userRole) {
            $currentRole = $userRole;
        }

        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'currentRole' => $currentRole,
        ];

        return view('usersmanagement.edit-user')->with($data);
    }



    public function destroy(User $user): RedirectResponse
    {
        if ($user->hasRole('admin')) {
            return back()->with('message', 'you are admin.');
        }
        $user->delete();

        return back()->with('message', 'User deleted.');
    }

}
