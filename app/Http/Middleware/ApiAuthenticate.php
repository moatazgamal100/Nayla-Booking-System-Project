<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $accessToken=$request->token;
            if($accessToken !== null){

                $user=JWTAuth::parseToken()->authenticate();

            }
         } catch (\Exception $e) {
            if($e instanceof TokenExpiredException){

                return response()->json([
                    'error_msg'=>'token is expired',
                ]);
            }
            elseif($e instanceof TokenInvalidException){
                return response()->json([
                    'error_msg'=>'token is invalid',
                ]);
            }
            elseif($e instanceof JWTException){
                return response()->json([
                    'error_msg'=>'token absent',
                ]);
            }
            else{
                return response()->json([
                    'error_msg'=>'something went wrong',
                ]);}

        }

        return $next($request);
    }
}
