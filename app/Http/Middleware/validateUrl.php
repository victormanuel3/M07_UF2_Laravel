<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class validateUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('post')  || $request->isMethod('put')) {
            // Validar solo si la solicitud es POST
            $imageURL = $request->img_url;
    
            // Verificar si la URL está presente y es válida
            if (!$imageURL || !filter_var($imageURL, FILTER_VALIDATE_URL)) {
                return redirect()->back()->withErrors(['img_url' => 'Invalid URL format.']);
            }
        }
        return $next($request);
    }
}
