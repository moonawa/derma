<?php

namespace App\Http\Controllers;

use App\Models\Medecin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 1;//1 correspond a medecin , 2 a patient
        $user->superadmin = 1;
        $user->telephone = $request->telephone;
        $user->adresse = $request->adresse;
        $user->sexe = $request->sexe;
        $user->avatar = $request->avatar;
        $user->status = 1;
        $user->save();  
        $medecin = new Medecin();
        $medecin->user_id = $user->id;
        $medecin->matricule = $request->matricule;
        $medecin->hopital = $request->hopital;
        $medecin->clinique = $request->clinique;
        $medecin->annee_de_commencement = $request->annee_de_commencement;
        $medecin->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('telephone', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }
    
    public function logout()
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    private function guard()
    {
        return Auth::guard();
    }

}
