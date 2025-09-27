<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->method() == 'POST' || $request->method() == 'PUT') {
            $input = $request->except('fingerprint', 'serverMemo', 'updates');
            array_walk_recursive($input, function (&$input) {
                $str = $input;
                $searchVal = array("<script>", "</script>");
                $replaceVal = array(" ", " ");
                $input = str_replace($searchVal, $replaceVal, $str);
            });
            $request->merge($input);
            return $next($request);

        } else {
            $input = $request->except('fingerprint', 'serverMemo', 'updates');
            array_walk_recursive($input, function (&$input) {
                $input = htmlentities($input);
            });
            $request->merge($input);
            return $next($request);
        }
    }
}
