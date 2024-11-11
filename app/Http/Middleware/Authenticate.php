<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // if ($request->is('admin/*')) {
        //     return route('admin.index'); // Redirect to admin login page if the route is admin-related
        // }

        return $request->expectsJson() ? null : route('login'); // Default login route for non-admins
    }
}
