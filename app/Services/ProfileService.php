<?php
namespace App\Services;
use App\Repositories\ProfileRepository;
use App\Http\Resources\ProfileResource;
use App\Http\traits\ApiHandler;

class ProfileService
{
    use ApiHandler;
    protected $profileRepository;
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function getProfile($id)
    {
        $user = $this->profileRepository->getUser($id);
        if($user==null)
        {
            return $this->notFound('User not found');
        }
        else
        {
            return new ProfileResource($user);
        }

    }
}
?>
