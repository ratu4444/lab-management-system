<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ControlCenterController extends Controller
{
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
        if (auth()->user()->type === User::TYPE_SUPERADMIN) return back()
            ->with('error', 'You can\'t edit your profile');

        return view('auth.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        if (auth()->user()->type === User::TYPE_SUPERADMIN) return back()
            ->with('error', 'You can\'t edit your profile');

        $request->validate([
            'name'      => 'required|string',
            'email'     => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id(), 'id'),
            ],
        ]);

        $profile_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
        ];

        if ($request->password) $profile_data['password'] = bcrypt($request->password);

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
