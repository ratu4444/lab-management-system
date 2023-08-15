<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('is_client', true)
            ->withCount('projects')
            ->paginate(10);

        return view('client.index', compact('clients'));
    }

    public function create()
    {
        return view('client.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ]);

        $client_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'mobile'        => $request->mobile,
            'company_name'  => $request->company_name,
            'is_client'     => true,
        ];

        try {
            User::create($client_data);

            return redirect()
                ->route('client.index')
                ->with('success', 'Client created successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }

    public function storeClientApi(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
        ]);

        $client_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'mobile'        => $request->mobile,
            'company_name'  => $request->company_name,
            'is_client'     => true,
        ];

        try {
            $user = User::create($client_data);

            $data = $this->formatUser($user);
            return $this->apiResponse($data, 'User created successfully');
        } catch (\Exception $exception) {
            return $this->apiResponse([], $exception->getMessage(), 500);
        }
    }
}
