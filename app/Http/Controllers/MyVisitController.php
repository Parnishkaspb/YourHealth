<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(MyVisit $myVisit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyVisit $myVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyVisit $myVisit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyVisit $myVisit)
    {
        //
    }
}
