<?php

namespace App\Http\Controllers\Authentication\API;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validateuser = validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]
            );
        if($validateuser->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'Validator Error',
                'error' => $validateuser->errors()->first()
            ],400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'user' => $user,
        ],200);

    }
    public function login(Request $request)
    {
        $validateuser = validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
            );
            if($validateuser->fails()){
                return response()->json([
                    'status'=> false,
                    'message' => 'Authentication Fails',
                    'error' => $validateuser->errors()->all()


                ],404);
            }
            if(Auth::attempt(['email'=> $request->email, 'password'=>$request->password])){
               $authuser= Auth::user();
               return response()->json([
                'status'=> true,
                'message' => 'User Loggin Successfully',
                'token' => $authuser->createToken('API Token')->plainTextToken,
                'token_type'=> 'bearer'

            ],404);

            }
            else{
                return response()->json([
                    'status'=> false,
                    'message' => 'Email and Password does not matched.',

                ],401);
            }

    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'status'=> true,
            'user'=> $user,
            'message' => 'You Logged out successfully.',

        ],200);


    }

    

}
