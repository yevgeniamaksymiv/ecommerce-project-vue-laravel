<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

class UserController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $response['token'] = $user->createToken('userToken')->plainTextToken;
            $response['name'] = $user->name;

            return response()->json($response, 200);

        } catch (error) {
            $response = [
                'message' => 'Цей емейл вже існує'
            ];
            return response()->json($response, 400);
        }

    }

    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            $response['token'] = $user->createToken('userToken')->plainTextToken;
//            $request->session()->regenerate();
            $response['name'] = $user->name;

            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Невірний емейл або пароль'
            ];
            return response()->json($response, 400);
        }
    }

    public function logout(Request $request)
    {


//        Auth::user()->tokens()->delete();

//        $request->user()->currentAccessToken()->delete();
//
//        if ($token = $request->bearerToken()) {
//            $model = Sanctum::$personalAccessTokenModel;
//            $accessToken = $model::findToken($token);
//            $accessToken->delete();
//        }

//        $user = $request->user();
//        foreach ($user->tokens as $token) {
//            $token->revoke();
//        }
//
//        Auth::logout();

//        auth('sanctum')->user()->tokens()->delete();
//
//        dd($request->user());

//          $request->user()->tokens()->delete();
        Auth::logout();
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
