<?php
namespace App\Services;
use App\Repositories\UserRepository;
use App\Http\Traits\ApiHandler;
use Illuminate\Support\Facades\Hash;
class UserService
{
    use ApiHandler;
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(array $data)
    {
        $user = $this->userRepository->Store($data);
        if ($user) {
            return $this->Createed('User created successfully', $user);
        }
        else {
            return $this->fail('User not created');
        }
    }

    public function update(array $data, $id)
    {
        if ($data['profile']) {
            foreach ($data['profile'] as $profile) {
                $filename= $profile->getClientOriginalName();
                $profile->move('images', $filename);
                $data['profile']= $filename;
            }
        }
        if ($data['password']) {
            $hashedPassword = Hash::make($data['password']);
            $data['password'] = $hashedPassword;
        }
        $user = $this->userRepository->update($data, $id);
        if ($user) {
            return $this->Createed('User updated successfully', $user);
        }
        else {
            return $this->fail('User not updated');
        }
    }
}
?>
