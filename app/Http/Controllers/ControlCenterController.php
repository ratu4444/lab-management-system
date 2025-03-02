<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ControlCenterController extends Controller
{

    public function researcherIndex($admin_id)
    {
        $clients = User::where('type', User::TYPE_CLIENT)
            ->where('parent_id', $admin_id)
            ->withCount('projects')
            ->latest()
            ->paginate(10);

        return view('client.index', compact('clients'));
    }

    public function index()
    {
        $admin_reports = [
            'type'              => 'admins',
            'heading'           => 'Total Admins',
            'card_icon'         => 'fa fa-users',
            'card_background'   => 'l-bg-orange',
            'count'             => User::whereAdmin()->count(),
            'url'               => route('control.admin.index'),
        ];

        $reports = [
            $admin_reports,
        ];

        return view('control.index', compact('reports'));
    }

    public function editProfile ()
    {
        return view('auth.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id(), 'id'),
            ],
            'avatar'    => 'nullable|image'
        ]);

        $profile_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
        ];

        if ($request->password) $profile_data['password'] = bcrypt($request->password);
        if ($request->file('avatar')) $profile_data['avatar'] = uploadFile($request->file('avatar'));

        try {
            auth()->user()->update($profile_data);

            return back()
                ->with('success', 'Profile updated successfully');
        } catch (\Exception $exception) {
            return back()
                ->with('error', $exception->getMessage());
        }
    }
}
