<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Retrieve all roles
        $roles = Role::all();

        return view('roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        // Show form to create a new role
        return view('roles.create');
    }

    public function store(Request $request)
    {
        // Validate and store a new role
        Role::create($request->validate([
            'name' => 'required|unique:roles|max:255',
            // Add other validation rules if necessary
        ]));

        return redirect()->route('roles.index');
    }

    // Other methods like edit, update, delete, etc.
}
