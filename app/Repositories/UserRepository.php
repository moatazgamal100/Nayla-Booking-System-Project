<?php
namespace App\Repositories;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository
{
    public function Store(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data = User::create($data);
        return $data;
    }
    public function Update(array $data, $id)
    {
        return User::where('id', $id)->update($data);
    }
}
?>
