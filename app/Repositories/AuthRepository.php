<?php
namespace App\Repositories;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthRepository
{
    public function login(array $data){
        return JWTAuth::attempt($data);
    }
}
?>
