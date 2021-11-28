<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request){
        try {
            $request->validate([
                'name' => ['required','string','max:255'],
                'username' => ['required','string','max:255','unique:users'],
                'email' => ['required','string','max:255','unique:users'],
                'phone' => ['nullable','string','max:255'],
                'role_id'=> ['required'],
                'password' => ['required','string',new Password],
            ]);

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'User Registered');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something whent worng',
                'error' => $error
            ], 'Authentitaction Failed', 500);
        }
    }

    public function login(Request $request){
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $credentials = request(['email','password']);
            if(!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message'=> 'Unauthorized'
                ], 'Authentication', 500);
            }
         $user = User::where('email', $request->email)->first();
         if (!Hash::check($request->password, $user->password, [])){
             throw new \Exception('Invalid Credentials');
         }

         $tokenResult = $user->createToken('authToken')->plainTextToken;
         return ResponseFormatter::success([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user
         ], 'Authenticated'); //return Respon Forrmater
        } catch (Exception $error){
            return ResponseFormatter::error([
                'message' => 'Unauthhorized'
            ], 'Authentication Failed', 500);
        }
    }

    public function fetch(Request $request){
        return ResponseFormatter::success($request->user(),'Data Profile Berhasil Diambil');
    }

    public function updateProfile(Request $request){
        $data = $request->all();

        $user = Auth::user();
        $user->update($data);

        return ResponseFormatter::success($request->user(),'Data Profile Updated');
    }

    public function logout(Request $request){
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($request->user(), 'Logout Success');
    }
}
