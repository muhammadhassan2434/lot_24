<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class buyerAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = $request->input('role');

        // Check if the role exists in the accounts table
        $accountExists = Account::where('role', $role)->exists();

        if (!$accountExists || $role !== 'buyer') {
            return response()->json([
                'status' => false,
                'message' => 'Access denied. Only buyers are allowed.',
            ], 403);
        }

        return $next($request); // Allow the request to proceed
    }
}
