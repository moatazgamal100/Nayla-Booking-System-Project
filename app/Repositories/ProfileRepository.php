<?php
namespace App\Repositories;
use App\Models\User;

class ProfileRepository
{
    public function getUser($id)
    {
        $user = User::findOrFail($id);
        return $user;

    }
}
?>
