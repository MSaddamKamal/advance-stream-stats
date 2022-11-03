<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\LogoutResource;
use App\Http\Resources\Auth\RegisterResource;
use App\Http\Resources\ErrorResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */
    protected UserRepository $user_repo;

    /**
     * @param UserRepository $user_repo
     */
    public function __construct(UserRepository $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    /**
     * @param RegisterRequest $request
     * @return RegisterResource
     */
    public function register(RegisterRequest $request): RegisterResource
    {
        $validated_response = $request->validated();
        $validated_response['password'] = Hash::make($validated_response['password']);

        $user = $this->user_repo->create($validated_response);

        return new RegisterResource($user);
    }

    /**
     * @param LoginRequest $request
     * @return LoginResource|ErrorResource
     */
    public function login(LoginRequest $request)
    {
        $requestData = $request->validated();
        if (!auth()->attempt($requestData)) {
            return new ErrorResource("Invalid Credentials");
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return (new LoginResource(auth()->user()))->additional(['access_token' => $accessToken]);

    }

    /**
     * @param Request $request
     * @return LogoutResource
     */
    public function logout(Request $request): LogoutResource
    {
        $token = $request->user()->token();
        $token->revoke();
        return new LogoutResource($request->user());
    }
}