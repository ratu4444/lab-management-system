<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $type = $request->user()->type;

        return match ($type) {
            User::TYPE_SUPERADMIN  => redirect()->route('dashboard.index'),
            User::TYPE_ADMIN       => $next($request),
            User::TYPE_CLIENT      => redirect()->route('dashboard.client-index'),
            default                => null,
        } ?? abort(403, 'Unauthorized action.');
    }
}
