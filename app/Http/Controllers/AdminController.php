<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::whereAdmin()
            ->withCount('clients')
            ->latest()
            ->paginate(10);

        return view('control.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('control.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ]);

        $admin_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'mobile'        => $request->mobile,
            'company_name'  => $request->company_name,
            'type'          => User::TYPE_ADMIN,
        ];

        try {
            User::create($admin_data);

            return redirect()
                ->route('control.admin.index')
                ->with('success', 'Admin created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function edit($admin_id)
    {
        $admin = User::whereAdmin()
            ->findOrFail($admin_id);

        return view('control.admin.edit', compact('admin'));
    }

    public function update(Request $request, $admin_id)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($admin_id, 'id'),
            ],
        ]);

        $admin = User::whereAdmin()->findOrFail($admin_id);

        $admin_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
        ];

        if ($request->password) $admin_data['password'] = bcrypt($request->password);

        try {
            $admin->update($admin_data);

            return redirect()
                ->route('control.admin.index')
                ->with('success', 'Admin updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}
