<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdministratorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdministratorController extends Controller
{
    public function index()
    {
        $activeMenu = 'system.administrator';
        $currentUserId = session('user_id');

        $administrator = AdministratorModel::where('id', '!=', $currentUserId)
            ->orderBy('name', 'asc')
            ->get();


        return view('admin.systems.administrator.index', compact('activeMenu', 'administrator'));
    }

    public function create()
    {
        $activeMenu = 'system.administrator';
        return view('admin.systems.administrator.create', compact('activeMenu'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:administrator,email',
            'password' => 'required|string|min:5|confirmed',
        ]);

        AdministratorModel::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'last_login' => now(),
            'active' => 1,
            'remember_token' => Str::random(10),
            'password' => $validated['password'],
        ]);

        return redirect()->route('admin.system.administrator.index')
                         ->with('success', 'Administrator created successfully.');
    }

    public function edit($id)
    {
        $administrator = AdministratorModel::findorfail($id);
        $activeMenu = 'system.administrator';
        return view('admin.systems.administrator.edit', compact('administrator', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $administrator = AdministratorModel::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:administrator,email,' . $administrator->id,
            'password' => 'nullable|string|min:5|confirmed',
        ]);

        $administrator->name = $validated['name'];
        $administrator->email = $validated['email'];

        if (!empty($validated['password'])) {
            $administrator->password = $validated['password'];
        }

        $administrator->save();

        return redirect()->route('admin.system.administrator.index')
                         ->with('success', 'Administrator updated successfully.');
    }

    public function update_active(Request $request, $id)
    {
        $request->validate([
            'active' => 'required|boolean',
        ]);

        $administrator = AdministratorModel::findOrFail($id);

        if (!$administrator) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $administrator->active = $request->active ? 1 : 0;
        $administrator->save();

        return response()->json(['message' => 'Active status updated successfully.']);
    }

    public function destroy($id)
    {
        $administrator = AdministratorModel::findorfail($id);
        $administrator->delete();
        return redirect()->route('admin.system.administrator.index')
                         ->with('success', 'Administrator deleted successfully.');
    }

}
