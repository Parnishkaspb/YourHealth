<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medic\{LoginRequest, RegisterRequest};
use App\Http\Resources\Medic\MedicResource;
use App\Models\Medic;
use Illuminate\Http\Request;
use App\Http\Resources\{LoginResponseResource, CodeResponseResource};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class MedicController extends Controller
{
    /**
     * Показать всех врачей в системе.
     */
    public function index()
    {
        return MedicResource::collection(Medic::with('profileAmbulance')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        try {
            $medic = Medic::create([
                'name' => e($request->name),
                'surname' => e($request->surname),
                'login' => e($request->login),
                'password' => $request->password,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'id_profile_ambulance' => $request->id_prodile_ambulance
            ]);

            $token = $medic->createToken('medicToken')->plainTextToken;
            return new LoginResponseResource(['token' => $token]);
        } catch (\Throwable $th) {
            return new CodeResponseResource(['message' => $th->getMessage(), 'code' => 422]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Medic $medic)
    {
        //
    }

    public function edit()
    {
        $user = Auth::user();
        return new MedicResource($user);
    }

    public function update(Request $request, Medic $medic)
    {
        $medic_auth = Auth::user();
        $allowedRoles = config('app.allowed_roles');

        if (!in_array($medic_auth->id_profile_ambulance, $allowedRoles)) {
            return new CodeResponseResource(['message' => 'У вас нет прав на это действие', 'code' => 403]);
        }

        try {
            $medic->update([
                'name' => e($request->name),
                'surname' => e($request->surname),
                'email' => $request->email,
                'telephone' => $request->telephone,
                'id_profile_ambulance' => $request->id_profile_ambulance
            ]);


            return new CodeResponseResource(['message' => 'Информация обновлена', 'code' => 200]);
        } catch (\Throwable $th) {
            return new CodeResponseResource(['message' => $th->getMessage(), 'code' => 422]);
        }
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
        $medic = Auth::guard('medic')->getProvider()->retrieveByCredentials($request->only('login', 'password'));

        if ($medic && Auth::guard('medic')->getProvider()->validateCredentials($medic, $request->only('password'))) {
            $token = $medic->createToken('medicToken')->plainTextToken;

            return new LoginResponseResource(['token' => $token]);
        }
        return new CodeResponseResource(['message' => 'Неверные учетные данные.', 'code' => 401]);
    }
    public function logout(Request $request)
    {
        auth('medic')->user()->tokens()->delete();

        return new CodeResponseResource(['message' => 'Вы успешно вышли из системы', 'code' => 200]);
    }
}
