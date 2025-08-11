<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function register(UserRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create([
            'name' => $validatedData["name"],
            'email' => $validatedData["email"],
            'password' => bcrypt($validatedData["password"])
        ]);
        return response()->json(["message" => "Usuario registrado correctamente"], 201);
    }

    public function login(LoginRequest $Request)
    {
        $validatedData = $Request->validated();

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ];

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Usuario o contraseña invalida'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo generar el token'], 500);
        }

        return $this->responWithToken($token);
    }

    public function who(){
        $user = auth()->user();
        return response()->json($user);
    }

    public function refresh(){
        try {
            $token = JWTAuth::getToken();
            $newToken = auth()->refresh();
            JWTAuth::invalidate($token);
            return $this->responWithToken($newToken);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Error al refrescar el token'], 500);
        }
    }

    protected function responWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type'=>'bearer', 
            'expires_in'=> auth()->factory()->getTTL()
        ]);
    }
}
