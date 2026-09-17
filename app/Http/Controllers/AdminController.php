<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('admin.index', compact('users'));
    }

    public function updateRole(UpdateUserRoleRequest $request, User $user)
    {
        if ($request->user()->id === $user->id) {
            return redirect()->route('admin.index')
                ->with('error', 'Voce nao pode alterar sua propria role.');
        }

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')
            ->with('success', 'Role atualizada.');
    }
}