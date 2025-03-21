<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $request->validate(["email" => "required", "password" => "required"]);
    //     $user = User::where("email", $request["email"])->first();
    //     // if (!$user || !Hash::check($request['password'], $user->password)) {
    //         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         return response()->json(["message" => "woking"]);
    //     }
    //     $token = $user->createToken("cv-app")->plainTextToken;
    //     $response = ["user" => $user, "token" => $token];
    //     return response()->json($response, 201);
    // }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        
        $token = JWTAuth::attempt($validator->validated();

        if (!$token)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }

    public function logout()
    {

        auth()->user()->tokens()->delete();

        $response = ["message" => "is logout"];

        return response()->json($response);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'lastname' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // public function register(Request $request)
    // {

    //     $validation =   $request->validate(["name" => "required", "lastname" => "required", "email" => "required", "password" => "required", "phone" => "required"]);

    //     if (!$validation) {
    //         return response()->json(["message" => "Not woking"]);
    //     }

    //     $data = $request->all();

    //     $data['password'] = bcrypt($data['password']);

    //     $user = User::create($data);

    //     $token =  $user->createToken('cv-app')->plainTextToken;

    //     $responseUser = ["user" => $user, "token" => $token];

    //     return response()->json(['user'=>$responseUser]);
    // }

    
}
