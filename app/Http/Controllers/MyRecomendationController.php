<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyRecomendation\MyRecomendationRequest;
use App\Http\Resources\CodeResponseResource;
use App\Http\Resources\Codes\{UnprocessableContentResponseResource, SuccessUpdateResponseResource, ErrorOutRuleResponseResource};
use App\Models\MyRecomendation;
use App\Models\MyVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyRecomendationController extends Controller
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
    public function store(MyRecomendationRequest $request)
    {
        try {
            MyRecomendation::create([
                'id_visit' => $request->id_visit,
                'id_user' => $request->id_user,
                'id_medic' => 2,
                // 'id_medic' => Auth::user()->id,
                'recomendation' => e($request->recomendation),
            ]);
            return new CodeResponseResource(['message' => 'Рекомендация добавлена', 'code' => 200]);
        } catch (\Throwable $th) {
            return new UnprocessableContentResponseResource(['message' => $th->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(MyRecomendation $myRecomendation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyRecomendation $myRecomendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MyRecomendationRequest $request, MyRecomendation $recomendation)
    {
        $id_medic = $recomendation->id_medic;
        $medic = Auth::user();
        $allowedRoles = config('app.allowed_roles');

        if ($medic->id !== $id_medic && !in_array($medic->id_profile_ambulance, $allowedRoles)) {
            return new ErrorOutRuleResponseResource([]);
        }
        try {
            $recomendation->update([
                'recomendation' => $request->recomendation
            ]);
            return new SuccessUpdateResponseResource([]);
        } catch (\Throwable $th) {
            return new UnprocessableContentResponseResource(['message' => $th->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyRecomendation $myRecomendation)
    {
        //
    }
}
