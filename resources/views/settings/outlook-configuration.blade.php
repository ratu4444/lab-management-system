@extends('custom-layout.master')
@section('title', 'Configure Outlook')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">Outlook Configuration</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                    <tr>
                        <th class="text-nowrap">User Name</th>
                        <th class="text-nowrap">User Email</th>
                        <th class="text-nowrap">Is Token Valid</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($outlook_account)
                        <tr>
                            <td>{{ $outlook_account->user_name }}</td>
                            <td>{{ $outlook_account->user_email }}</td>
                            <td>
                                <div class="badge {{ $outlook_account->is_expired ? 'badge-danger' : 'badge-success' }}">{{ $outlook_account->is_expired ? 'No': 'Yes' }}</div>
                            </td>
                            <td class="text-nowrap">
                                @if($outlook_account->is_expired)
                                    <a href="{{ route('oauth.authorize', $outlook_account->app_name) }}" class="btn btn-success btn-sm">Relogin</a>
                                @else
                                    <a href="{{ route('oauth.refresh', $outlook_account->app_name) }}" class="btn btn-primary btn-sm">Refresh Token</a>
                                @endif
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">
                                <a href="{{ route('oauth.authorize', \App\Models\OauthToken::APP_NAMES['OUTLOOK']) }}" class="btn btn-primary">Add Outlook Account</a>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

@endsection
