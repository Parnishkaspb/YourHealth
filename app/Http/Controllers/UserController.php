<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\{LoginRequest, RegisterRequest};
use App\Http\Resources\{CodeResponseResource, LoginResponseResource};
use App\Http\Resources\User\UserResponceResource;
use App\Models\User;
use Illuminate\Support\Facades\{Auth, Request};

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('userToken', ['*'])->plainTextToken;

            return new LoginResponseResource(['token' => $token]);
        }

        return new CodeResponseResource(['message' => 'Неверные учетные данные.', 'code' => 401]);
    }


    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'login' => $request->login,
                'password' => $request->password,
                'name' => $request->name,
                'surname' => $request->surname,
                'telephone' => $request->telephone,
                'passport' => $request->passport,
                'address' => $request->address,
            ]);

            $token = $user->createToken('userToken')->plainTextToken;
            return new LoginResponseResource(['token' => $token]);
        } catch (\Throwable $th) {
            return new CodeResponseResource(['message' => $th->getMessage(), 'code' => 422]);
        }
    }

    public function edit()
    {
        $user = Auth::user();
        return new UserResponceResource($user);
    }

    public function update(RegisterRequest $request, User $user)
    {
        $user_auth = Auth::user();
        if (!$user_auth || $user_auth->id !== $user->id) {
            return new CodeResponseResource(['message' => 'Нет прав на выполнение этих действий', 'code' => 403]);
        }
        try {
            $user->update([
                'login' => $request->login,
                'password' => $request->password,
                'name' => $request->name,
                'surname' => $request->surname,
                'telephone' => $request->telephone,
                'passport' => $request->passport,
                'address' => $request->address,
            ]);

            return new CodeResponseResource(['message' => 'Информация обновлена', 'code' => 200]);
        } catch (\Throwable $th) {
            return new CodeResponseResource(['message' => $th->getMessage(), 'code' => 422]);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return new CodeResponseResource(['message' => 'Вы успешно вышли из системы', 'code' => 200]);
    }
}



