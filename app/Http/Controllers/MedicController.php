<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medic\LoginRequest;
use App\Http\Requests\Medic\RegisterRequest;
use App\Models\Medic;
use Illuminate\Http\Request;
use App\Http\Resources\LoginResponseResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

// class UserController extends Controller
// {
//     public function login(LoginRequest $request)
//     {

//         if (Auth::attempt($request->only('login', 'password'))) {
//             $user = Auth::user();
//             $token = $user->createToken('authToken')->plainTextToken;

//             return new LoginResponseResource(['token' => $token]);
//         }

//         return response()->json(['message' => 'Неверные учетные данные.'], 401);
//     }

//     public function register(RegisterRequest $request)
//     {
//         try {
//             $user = User::create([
//                 'login' => $request->login,
//                 'password' => $request->password,
//                 'name' => $request->name,
//                 'surname' => $request->surname,
//                 'telephone' => $request->telephone,
//                 'passport' => $request->passport,
//                 'address' => $request->address,
//             ]);

//             $token = $user->createToken('authToken')->plainTextToken;
//             return new LoginResponseResource(['token' => $token]);
//         } catch (\Throwable $th) {
//             return response()->json(['message' => $th->getMessage()], 422);
//         }
//     }

//     public function logout(Request $request)
//     {
//         auth()->user()->tokens()->delete();

//         return response()->json(['message' => 'Вы успешно вышли из системы']);
//     }
class MedicController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        try {
            $medic = Medic::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'login' => $request->login,
                'password' => $request->password,
                'email' => $request->email,
                'telephone' => $request->telephone
            ]);

            $token = $medic->createToken('medicToken')->plainTextToken;
            return new LoginResponseResource(['token' => $token]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medic $medic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medic $medic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medic $medic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medic $medic)
    {
        //
    }

    public function login(LoginRequest $request)
    {
        if (Auth::guard('medic')->attempt($request->only('login', 'password'))) {
            $medic = Auth::guard('medic')->user();
            $token = $medic->createToken('medicToken')->plainTextToken;

            return new LoginResponseResource(['token' => $token]);
        }

        return response()->json(['message' => 'Неверные учетные данные.'], 401);
    }
    public function logout(Request $request)
    {
        auth('medic')->user()->tokens()->delete();


        return response()->json(['message' => 'Вы успешно вышли из системы']);
    }
}
