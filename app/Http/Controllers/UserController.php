<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $input             = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);

        return response()->json([
            'res'     => true,
            'message' => 'Registro creado correctamente',

        ], 200);
    }

    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (!is_null($user) && Hash::check($request->password, $user->password)) {
            $str = rand();

            $token = $user->createToken('contactos')->accessToken;

            return response()->json([
                'res'     => true,
                'token'   => $token,
                'message' => 'Bienvenido a la agenda',

            ], 200);
        } else {
            return response()->json([
                'res'     => false,
                'message' => 'Cuenta o contraseña incorrectas',

            ], 200);
        }

    }

    public function logout()
    {
        $user = auth()->user();
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json([
            'res'     => true,
            'message' => 'Sesion cerrada',

        ], 200);
    }
}
