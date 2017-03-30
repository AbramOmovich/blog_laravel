<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class ArticleSecure
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->role != User::ROLE_ADMIN || $request->user()->role != User::ROLE_MODERATOR ){
            abort(403);
        }


        return $next($request);
    }
}
