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
        /*  return $request->expectsJson() ? null : route('login'); */

        if ($request->expectsJson()) {
            return null; // No redirection for JSON requests
        }

        // Check if the request is for the student page and user is not authenticated
        if ($request->is('student/*') && !auth()->check()) {
            return route('student.login'); // Redirect to the student login page
        }

        return route('login'); // Redirect others to the default login page
    }
}
