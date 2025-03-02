<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index()
    {
        $clients = auth()->user()->clients()
            ->withCount('projects')
            ->latest()
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
            'skills'        => $request->skills,
            'type'          => User::TYPE_CLIENT,
            'parent_id'     => auth()->id(),
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
            'type'          => User::TYPE_CLIENT,
            'parent_id'     => auth()->id(),
        ];

        try {
            $user = User::create($client_data);

            $data = $this->formatUser($user);
            return $this->apiResponse($data, 'User created successfully');
        } catch (\Exception $exception) {
            return $this->apiResponse([], $exception->getMessage(), 500);
        }
    }

    public function edit($client_id)
    {
        $client = auth()->user()->clients()
            ->find($client_id);
        if (!$client) return back()->with('error', 'Researcher Not Found');

        return view('client.edit', compact('client'));
    }

    public function update(Request $request, $client_id)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($client_id, 'id'),
            ],
        ]);

        $client = auth()->user()->clients()
            ->find($client_id);
        if (!$client) return back()->with('error', 'Researcher Not Found');

        $client_data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'skills'         => $request->skills,
        ];

        if ($request->password) $client_data['password'] = bcrypt($request->password);

        try {
            $client->update($client_data);

            return redirect()
                ->route('client.index')
                ->with('success', 'Client updated successfully');
        } catch (\Exception $exception) {
            return redirect()
                ->back()
                ->with('error', $exception->getMessage());
        }
    }
}
