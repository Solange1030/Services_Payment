<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use Exception;

class AuthController extends Controller
{

    public function sign_up(Request $request)
    {
        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'contact' => 'required|string|max:13',
                'gender' => 'required|string|max:10',
            ]);

            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $client = Client::create([
                'user_id'=> $user->id,
                'email' => $validated['email'],
                'name' => $validated['name'],
                'contact' => $validated['contact'],
                'gender' => $validated['gender'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Utilizador registado com sucesso',
                'data' => [
                    'user' => $user,
                    'client' => $client
                ]
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'status' => false,
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Erro interno do servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }


        public function sign_in(Request $request)
        {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {

                return response()->json([
                    'status' => true,
                    'message' => 'Login realizado com sucesso',
                    'user' => Auth::user()
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Credenciais inválidas'
            ],401);
        }


    public function log_out(Request $request)
    {
        try {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'status' => true,
                'message' => 'Logout realizado com sucesso'
            ]);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Erro ao fazer logout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}