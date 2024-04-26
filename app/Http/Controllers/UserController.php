<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\LoginResponseResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    // public function login(LoginRequest $request)
    // {

    //     if (Auth::attempt($request->only('login', 'password'))) {
    //         $user = Auth::user();
    //         $token = $user->createToken('authToken')->plainTextToken;

    //         return new LoginResponseResource(['token' => $token]);
    //     }

    //     return response()->json(['message' => 'Неверные учетные данные.'], 401);
    // }
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('userToken', ['*'])->plainTextToken;

            return new LoginResponseResource(['token' => $token]);
        }

        return response()->json(['message' => 'Неверные учетные данные.'], 401);
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
            return response()->json(['message' => $th->getMessage()], 422);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Вы успешно вышли из системы']);
    }
}



