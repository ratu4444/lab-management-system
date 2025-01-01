<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class checkClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $type = $request->user()->type;

        return match ($type) {
            User::TYPE_SUPERADMIN  => redirect()->route('control.index'),
            User::TYPE_ADMIN       => redirect()->route('dashboard.admin-index'),
            User::TYPE_CLIENT      => $next($request),
            default                => null,
        } ?? abort(403, 'Unauthorized action.');
    }
}
