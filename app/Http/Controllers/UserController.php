<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users', $users);
    }

    public function show(User $user)
    {
        return view('users', [
            'user' => User::findOrFail($user)
        ]);
    }
}
