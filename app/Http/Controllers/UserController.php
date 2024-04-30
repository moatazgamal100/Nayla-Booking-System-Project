<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $registerService)
    {
        $this->registerService = $registerService;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $user=$request->validated();
        $result=$this->registerService->register($user);
        return $result;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
        $result= $this->registerService->update($data, $id);
        return $result;
    }
}
