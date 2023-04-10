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
use Illuminate\Support\Facades\Session;

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

            Auth::login($user);
            $response['token'] = $user->createToken('userToken')->plainTextToken;
            $response['name'] = $user->name;
            $response['surname'] = $user->surname;
            $response['id'] = $user->id;

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

            Auth::login($user);
            $user->tokens()->delete();
            $response['token'] = $user->createToken('userToken')->plainTextToken;
            $response['name'] = $user->name;
            $response['surname'] = $user->surname;
            $response['id'] = $user->id;

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
        Session::flush();
        Auth::logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
