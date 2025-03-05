@extends('custom-layout.master')
@section('title', 'Notification Email')
@push('css')
@endpush

@section('content')
    <div class="container">
        <h3>Send Mail to {{ $admin->name }}</h3>
        <form action="{{ route('control.admin.mail-send', $admin->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">Notification</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Mail</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
