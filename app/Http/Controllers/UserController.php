<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'sometimes|string',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => app('hash')->make($request->input('password')),
            'role' => $request->input('role', 'user'),
        ]);
        return response()->json(['message' => 'User created.', 'data' => $user], 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
            'role' => 'sometimes|string',
        ]);
        $user = User::findOrFail($id);
        $data = $request->only(['name', 'email', 'role']);
        if ($request->filled('password')) {
            $data['password'] = app('hash')->make($request->input('password'));
        }
        $user->update($data);
        return response()->json(['message' => 'User updated.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted.']);
    }
}
