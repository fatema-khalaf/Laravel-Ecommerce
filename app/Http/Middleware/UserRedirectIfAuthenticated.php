<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\cache;
use App\Models\User;
use Carbon\Carbon;
class UserRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        /**new idea
         * this function will execute whenever the user uses the routes protected with this middleware.
         * if the user still logged in but did not hit any protected routes will appear as
         * inactive as the chached item 
         * will be deleted after the expireTime. And will be re created once the user interact
         * with the website again (only the protected routs)
         */ 
        if(Auth::check()){
            $expireTime = Carbon::now()->addSeconds(30); //the desired expiration time of the cached item
            Cache::put('user-is-online'. Auth::user()->id , true, $expireTime);// put user-isonline user->id item in the cach and deleted after the expireTime
            User::where('id',Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }
        
        // new idea 
        if(Auth::check() && Auth::user()){
            return $next($request);
        }else{
            return redirect()->route('login');
        }
    }
}
