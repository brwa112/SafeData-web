<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    // generate all functions for user
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::with('roles', 'permissions')
            ->orderBy('name')
            ->get();

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return Inertia::render('Users/Form', [
            ...$this->options(),
        ]);
    }

    public function store()
    {
        $this->authorize('create', User::class);

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|min:8',
            'is_active' => 'required',
            'roles' => 'array',
            'permissions' => 'array',
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $user->syncRoles($data['roles']);
        $user->syncPermissions($data['permissions']);

        return redirect()->route('control.system.users.index');
    }

    public function edit($user)
    {
        $this->authorize('update', User::class);

        $user = User::with('roles', 'permissions')->findOrFail($user);

        return Inertia::render('Users/Form', [
            'user' => $user->load('roles', 'permissions'),
            ...$this->options(),
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar');
            $user->addMediaFromRequest('avatar')->preservingOriginal()->toMediaCollection('avatar');
        } elseif ($request->input('remove_avatar')) {
            $user->clearMediaCollection('avatar');
        }

        $user->roles()->sync(collect($data['roles'])->pluck('id'));
        $user->permissions()->sync(collect($data['permissions'])->pluck('id'));
    }

    protected function options()
    {
        $roles = Role::query()
            ->with([
                'permissions' => function ($query) {
                    $query->select(['id', 'name', 'group']);
                },
            ])
            ->get();

        $permission_groups = Permission::query()
            ->select(['id', 'name', 'group'])
            ->get()
            ->groupBy('group');

        return [
            'roles' => $roles,
            'permission_groups' => $permission_groups,
        ];
    }
}
