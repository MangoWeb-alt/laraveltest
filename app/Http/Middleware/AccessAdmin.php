<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
use Illuminate\Support\Facades\Route;
use Psr\Log\NullLogger;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function handle($request, Closure $next)
    {
        $actions = Route::getCurrentRoute()->getAction();
        $roles = isset($actions['roles']) ? $actions['role'] : Null;
        if($this->admin->hasRole($roles) || !$roles){
            return $next($request);
        } else {
            return abort(401);
        }


    }
}
