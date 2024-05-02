<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileAmbulance\CreateRequest;
use App\Http\Resources\CodeResponseResource;
use App\Http\Resources\Codes\{ErrorOutRuleResponseResource, UnprocessableContentResponseResource, SuccessUpdateResponseResource};
use App\Http\Resources\ProfileAmbulance\AllProfileAmbulancesResponseResource;
use App\Models\ProfileAmbulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileAmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = ProfileAmbulance::all();
        return AllProfileAmbulancesResponseResource::collection($all);
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
    public function store(CreateRequest $request)
    {
        $medic = Auth::user();
        $allowedRoles = config('app.allowed_roles');
        if (!in_array($medic->id_profile_ambulance, $allowedRoles)) {
            return new ErrorOutRuleResponseResource([]);
        }

        try {
            ProfileAmbulance::create([
                'specialization' => e($request->specialization)
            ]);
            return new CodeResponseResource(['message' => 'Новая специальность добавлена в систему', 'code' => 200]);
        } catch (\Throwable $th) {
            return new UnprocessableContentResponseResource(['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileAmbulance $profileAmbulance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfileAmbulance $profileAmbulance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, ProfileAmbulance $specialization)
    {
        $medic = Auth::user();
        $allowedRoles = config('app.allowed_roles');
        if (!in_array($medic->id_profile_ambulance, $allowedRoles)) {
            return new ErrorOutRuleResponseResource([]);
        }

        try {
            $specialization->update([
                'specialization' => e($request->specialization)
            ]);
            return new SuccessUpdateResponseResource([]);
        } catch (\Throwable $th) {
            return new UnprocessableContentResponseResource(['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfileAmbulance $profileAmbulance)
    {
        //
    }
}
