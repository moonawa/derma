<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Consultation::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //création d'une consultation par un patient
    public function store(Request $request)
    {
    $user = Auth::user();
    $patient = Patient::where('user_id', $user->id)->first();
    $consultation = new Consultation();
    $consultation->medecin_id = $request->medecin_id;
    $consultation->patient_id = $patient;
    $consultation->photo1 = $request->photo1;
    $consultation->photo2 = $request->photo2;
    $consultation->photo3 = $request->photo3;
    $consultation->photo4 = $request->photo4;
    $consultation->etat_patient = $request->etat_patient;
    $consultation->autre_medicament = $request->autre_medicament;
    $consultation->save();
    return response()->json(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
