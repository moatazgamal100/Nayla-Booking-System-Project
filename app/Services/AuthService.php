<?php
namespace App\Services;
use App\Repositories\AuthRepository;
use App\Http\Traits\ApiHandler;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ApiHandler;
    protected $authrepository;
    public function __construct(AuthRepository $authrepository)
    {
        $this->authrepository = $authrepository;
    }
    public function login($data){
        $token=$this->authrepository->login($data);
        if(!$token){
            return $this->fail("invalid credentials");
        }
        else {
            $user = auth()->user();
            if ($user['email'] === 'moatazgamal11@gmail.com') {
                return $this->loginSuccess("login successfully",$token,$user,true);
            } else {

            return $this->loginSuccess("login successfully",$token,$user,false);
        }
        }
        return $token;
    }
}
?>
