<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
{
    // Capture the search input from the request
    $search = $request->input('search');

    $permissions = Permission::query()
        // If a search query exists, filter by name
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        // Sort by newest first
        ->latest()
        // Use Bootstrap-friendly pagination
        ->paginate(10)
        // Ensure the search query stays in the URL during pagination
        ->withQueryString();

    return view('permissions.index', compact('permissions', 'search'));
}

    public function create() {
        return view('permissions.create');
    }

    public function store(Request $request) {
        $request->validate(['name'=>'required|unique:permissions,name']);
        Permission::create(['name'=>$request->name]);
        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission) {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission) {
        $permission->update(['name'=>$request->name]);
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return back();
    }
}
