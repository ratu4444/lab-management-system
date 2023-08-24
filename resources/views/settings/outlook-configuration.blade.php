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
                        <th class="text-nowrap">Expiration Time</th>
                        <th class="text-nowrap">Last Refreshed Time</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($outlook_account)
                        <tr>
                            <td class="text-nowrap">{{ $outlook_account->user_name }}</td>
                            <td class="text-nowrap">{{ $outlook_account->user_email }}</td>
                            <td class="text-nowrap">
                                <div class="badge {{ $outlook_account->is_expired ? 'badge-danger' : 'badge-success' }}">{{ $outlook_account->is_expired ? 'No': 'Yes' }}</div>
                            </td>
                            <td class="text-nowrap">{{ $outlook_account->expiration_time }}</td>
                            <td class="text-nowrap">{{ $outlook_account->last_refreshed_time }}</td>
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
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">Inspection Mail Configuration</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.mail-configuration') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                        <label class="form-label" for="mail_subject">Mail Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="mail_subject" id="mail_subject" value="{{ old('mail_subject') ?? $mail_configuration?->mail_subject }}" required>

                        <div class="invalid-feedback">
                            Mail Subject is required
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label class="form-label" for="mail_body">Mail Body <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="mail_body" id="mail_body" required>{{ old('mail_body') ?? $mail_configuration?->mail_body }}</textarea>
                        <div class="invalid-feedback">
                            Mail Body is required
                        </div>
                    </div>

                    <input type="hidden" name="app_name" value="{{ \App\Models\OauthToken::APP_NAMES['OUTLOOK'] }}">
                </div>
                <button type="submit" class="btn btn-primary">Update Configuration</button>
            </form>
        </div>
    </div>
@endsection
