<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);

        $filters = $this->getFilters($request);

        $users = User::with('roles', 'permissions')
            ->search($filters['search'])
            ->orderBy($filters['sort_by'], $filters['sort_direction'])
            ->paginate($filters['number_rows']);

        return Inertia::render('System/Users/Index', [
            'users' => $users,
            'filter' => $filters,
        ]);
    }

    protected function getFilters(Request $request)
    {
        return collect([
            'search' => $request->query('filter')['search'] ?? '',
            'number_rows' => $request->query('filter')['number_rows'] ?? 10,
            'sort_by' => $request->query('filter')['sort_by'] ?? 'id',
            'sort_direction' => $request->query('filter')['sort_direction'] ?? 'desc',
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return Inertia::render('System/Users/Form', [
            ...$this->options(),
        ]);
    }

    public function store()
    {
        $this->authorize('create', User::class);

        // $data = request()->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'phone' => 'required',
        //     'password' => 'required|min:8',
        //     'is_active' => 'required',
        //     'roles' => 'array',
        //     'permissions' => 'array',
        // ]);

        // $data = $request->validated();

        // $data['password'] = bcrypt($data['password']);

        // $user = User::create($data);

        // $user->roles()->sync(collect($data['roles'])->pluck('id'));
        // $user->permissions()->sync(collect($data['permissions'])->pluck('id'));

        // return redirect()->route('control.system.users.index');
    }

    public function edit($user)
    {
        $this->authorize('update', User::class);

        $user = User::with('roles', 'permissions')->findOrFail($user);

        return Inertia::render('System/Users/Form', [
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

    public function destroy($user)
    {
        $this->authorize('delete', User::class);

        $user = User::findOrFail($user);

        $user->delete();

        // return redirect()->route('control.system.users.index');
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
