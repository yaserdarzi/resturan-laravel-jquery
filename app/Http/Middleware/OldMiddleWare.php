<?php

namespace Res\Http\Middleware;

use Closure;

class OldMiddleWare
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
      if ($request->input('age')<14){
        return redirect('/user/message');
      }
        return $next($request);
    }
}
