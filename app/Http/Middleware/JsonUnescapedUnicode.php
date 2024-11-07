<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class JsonUnescapedUnicode
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
        /** @var \Illuminate\Http\Response $response */
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }
}
