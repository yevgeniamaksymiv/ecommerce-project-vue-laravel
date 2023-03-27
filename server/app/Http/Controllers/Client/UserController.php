<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

            $data['token'] = $user->createToken('userToken')->plainTextToken;
            $data['name'] = $user->name;
            $response = [
                'data' => $data,
                'message' => 'Ви успішно зареєструвались'
                ];
            return response()->json($response, 200);

        } catch (error) {
            $response = [
                'message' => $request->messages()
            ];
            return response()->json($response, 400);
        }

    }

    public function login(LoginUserRequest $request)
    {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = $request->user();
                $data['token'] = $user->createToken('userToken')->plainTextToken;
                $data['name'] = $user->name;

            $response = [
                'data' => $data,
                'message' => 'Ви успішно ввійшли в свій акаунт'
            ];
            return response()->json($response, 200);
            } else {
                $response = [
                    'error' => 'Невірний емейл або пароль'
                ];
                return response()->json($response, 400);
            }
    }
}
