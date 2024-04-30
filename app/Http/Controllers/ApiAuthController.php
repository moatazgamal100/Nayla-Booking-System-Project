<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginApiRequest;
use App\Http\Traits\ApiHandler;
use App\Services\AuthService;

class ApiAuthController extends Controller
{
    use ApiHandler;
    protected $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }


    public function login(LoginApiRequest $request)
    {
        $data = $request->validated();
        $result=$this->authService->login($data);
        return $result;

    }


    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);

            return $this->Success("logout successfully");
        } catch (\JWTException $e) {
            return $this->fail($e->getMessage());
        }
    }
}
