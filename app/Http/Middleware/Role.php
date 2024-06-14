<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('loginScreen');
        } else {
            $user = Auth::user();
            if ($user->role == User::ROLE_ADMIN) {
                return $next($request);
            } else {
                if ($user->id == $request->id) {
                    return $next($request);
                } else {
                    return redirect()->back()->withErrors(Config::get('constants.error_messages.modify_own_profile'))->withInput();
                }
            }
        }
    }
}
