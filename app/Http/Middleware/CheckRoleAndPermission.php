<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAndPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role, $permission)
    {
        // Memeriksa apakah role ada di session
        $userRole = session('role');  // Ambil role dari session
        $permissions = session('permissions');  // Ambil permissions dari session

        // Memeriksa apakah role sesuai
        if ($userRole !== $role) {
            return response()->json([
                'alert-type' => 'error',
                'message' => 'Akses ditolak: Role yang Anda miliki tidak sesuai.'
            ], 403);
        }

        // Memeriksa apakah user memiliki permission
        foreach ($permissions as $permission) {
            if (!in_array($permission, session('permissions'))) {
                return response()->json([
                    'alert-type' => 'error',
                    'message' => "Akses ditolak: Anda tidak memiliki izin untuk melakukan tindakan '$permission'."
                ], 403);
            }
        }

        // Jika role dan permission sesuai, lanjutkan request
        return $next($request);
    }
}
