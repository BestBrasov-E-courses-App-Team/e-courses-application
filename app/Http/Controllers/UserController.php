<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

/**
 * Summary of UserController
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(!$request->user()->can('users.view'), 403);

        $users = User::with('roles');
        if ($request->q) {
            $users = $users->search($request->q);
        } else {
            $users = $users;
        }
        $users = $users->paginate(20);
        return Inertia::render('App/Users/Parts/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!auth()->user()->can('users.create'), 403);

        $roles = Role::all()->pluck('name');
        return Inertia::render('App/Users/Parts/Create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('users.create'), 403);

        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'bail|required'
        ])->stopOnFirstFailure(true);

        $validator->validate();

        if (User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ])) {
            $user = User::where('email', $request->email)->first()->syncRoles($request->roles);
            return redirect()->route('users.index');
        } else {
            $request->session()->flash('error', 'Nu s-a putut adăuga utilizatorul');
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_if(!auth()->user()->can('users.edit'), 403);

        if ($user) {
            $userRoles = $user->roles->pluck('name');
        }
        $roles = Role::all()->pluck('name');
        return Inertia::render('App/Users/Parts/Edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        abort_if(!auth()->user()->can('users.edit'), 403);

        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'email' => "bail|required|email|unique:users,email,{$user->id},id",
            'roles' => 'bail|required',
        ])->stopOnFirstFailure(true);

        $validator->validate();

        if ($user->update([
            'name' => $request->name,
            'email' => $request->email,
        ])) {

            $user->syncRoles($request->roles);
            $this->flashSuccess('Utilizatorul a fost actualizat cu succes');
            return redirect()->route('users.index');
        } else {
             $this->flashError('Nu s-au putut actualiza datele utilizatorului');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user, Request $request)
    {
        abort_if(!auth()->user()->can('users.delete'), 403);

        $user->delete();
        return;
    }
}
