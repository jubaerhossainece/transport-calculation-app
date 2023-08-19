<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        DB::beginTransaction();

        try {
            $user = User::create($request->validated());
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return errorResponseJson($exception->getMessage(), 500);
        }

        return successResponseJson([
            'access_token' => $user->createToken('authToken')->accessToken,
            'user' => new UserResource($user)
        ], 'Registration successful.');
    }

    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return errorResponseJson('Credentials not matched.', 401);
            }
            $user = User::where('email', $request->email)->firstOrFail();
        } catch (Exception $error) {
            return errorResponseJson($error->getMessage(), 422);
        }

        return successResponseJson([
            'access_token' => $user->createToken('authToken')->accessToken,
            'user' => new UserResource($user)
        ], 'Login Success');
    }
}
