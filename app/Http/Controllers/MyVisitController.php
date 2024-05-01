<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyVisit\CreateRegister;
use App\Http\Resources\CodeResponseResource;
use App\Http\Resources\MyVisit\VisitResponseResource;
use App\Models\MyVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyVisitController extends Controller
{
    /**
     * Display a listing of the user's visits.
     *
     */
    public function index()
    {
        $user = Auth::user();
        $visits = $user->visits()->with(['recommendations', 'medic'])->get();
        return VisitResponseResource::collection($visits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRegister $request)
    {
        $user = Auth::user();
        if (!$user->firstOrder) {
            $user->update(['firstOrder' => 1]);
        }

        try {
            MyVisit::create([
                'id_user' => $user->id,
                'id_medic' => $request->id_medic,
                'datetomedic' => $request->datetomedic,
                'timetomedic' => $request->timetomedic,
            ]);
            return new CodeResponseResource(['message' => 'Запись успешно создана. Дата: ' . $request->datetomedic . ' время: ' . $request->timetomedic, 'code' => 200]);
        } catch (\Throwable $th) {
            return new CodeResponseResource(['message' => $th->getMessage(), 'code' => 422]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(MyVisit $visit)
    {
        return new VisitResponseResource($visit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRegister $request, MyVisit $visit)
    {
        $user = Auth::user()->id;

        if ($visit->id_user !== $user) {
            return new CodeResponseResource(['message' => 'У вас нет прав на это действие', 'code' => 403]);
        }

        $dateTimeString = $visit->datetomedic . ' ' . $visit->timetomedic;

        if (strtotime($dateTimeString) < time()) {
            return new CodeResponseResource(['message' => 'Нельзя изменить дату приема врача, которая прошла', 'code' => 422]);
        }


        try {
            $visit->update([
                'datetomedic' => $request->datetomedic,
                'timetomedic' => $request->timetomedic
            ]);
            return new CodeResponseResource(['message' => 'Обновление произошло успешно', 'code' => 200]);
        } catch (\Throwable $th) {
            return new CodeResponseResource(['message' => $th->getMessage(), 'code' => 422]);
        }
    }

    /**
     * Человек пришел на прием к врачу.
     */
    public function people_came(MyVisit $visit)
    {
        $user = Auth::user();
        $allowedRoles = config('app.allowed_roles');
        if ($visit->id_medic !== $user->id && !in_array($user->id_profile_ambulance, $allowedRoles)) {
            return new CodeResponseResource(['message' => 'У вас нет прав на это действие', 'code' => 403]);
        }


        try {
            $on = ($visit->visit === 0) ? 1 : '0';
            $visit->update(['visit' => $on]);
            return new CodeResponseResource(['message' => 'Обновление произошло успешно', 'code' => 200]);
        } catch (\Throwable $th) {
            return new CodeResponseResource(['message' => $th->getMessage(), 'code' => 422]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyVisit $visit)
    {
        //
    }
}
