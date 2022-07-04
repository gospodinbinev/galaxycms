<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\UpdateUserPasswordRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\Admin\UserService;
use Yajra\DataTables\DataTables;

class UsersController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    public function getData()
    {
        return Datatables::of(User::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Giving an array of IDs and names to LaravelCollective select
        $roles = [];
        foreach (Role::all() as $role) {
            $roles += [$role->id => $role->name];
        }

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request, UserService $userService)
    {
        $user = $userService->createUser($request);

        return redirect()->route('admin.users.index')->withSuccess('New user added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Giving an array of IDs and names to LaravelCollective select
        $roles = [];
        foreach (Role::all() as $role) {
            $roles += [$role->id => $role->name];
        }

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, UserService $userService, $id)
    {
        $user = $userService->updateUser($request, $id);

        return redirect()->route('admin.users.index')->withSuccess('User updated successfully!');
    }

    public function changePassword(UpdateUserPasswordRequest $request, UserService $userService, $id)
    {
        $user = $userService->changePassword($request, $id);

        return redirect()->route('admin.users.index')->withSuccess('User password updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserService $userService, $id)
    {
        $user = $userService->deleteUser($id);

        return redirect()->route('admin.users.index')->withSuccess('User deleted successfully!');
    }
}
