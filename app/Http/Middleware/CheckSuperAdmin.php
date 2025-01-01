<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckSuperAdmin
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
            User::TYPE_SUPERADMIN  => $next($request),
            User::TYPE_ADMIN       => redirect()->route('dashboard.admin-index'),
            User::TYPE_CLIENT      => redirect()->route('dashboard.client-index'),
            default                => null,
        } ?? abort(403, 'Unauthorized action.');
    }
}
