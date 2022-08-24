<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with('user')->get();
        return response()->json(
            [
                'status' => 'success',
                'users' => $patients->toArray()
            ], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
            'telephone' => 'required',
            //'status' => 'required',
            'name' => 'required',
            //'role' => 'required',
            'adresse' => 'required',
            'sexe' => 'required',
            //'avatar' => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        //$pass= $this->genreratePassword(8);
        //$imageName = time().'.'.$request->image->getClientOriginalExtension();
        //$request->image->move(public_path('images'), $imageName);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 2;//1 correspond a medecin , 2 a patient
        $user->superadmin = 0;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;
        $user->sexe = $request->sexe;
        //$user->avatar = $imageName;
        $user->avatar = $request->avatar;
        $user->status = 1;
        $user->save();  
        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->birthday = $request->birthday;
        $patient->antecedent = $request->antecedent;
        $patient->save();
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
        //$patient = Patient::find($id);
        $patient = Patient::with('user')->find($id);
        return response()->json(
            [
                'status' => 'success',
                'user' => $patient->toArray()
            ], 200);
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
