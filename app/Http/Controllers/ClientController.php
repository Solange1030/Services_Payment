<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ClientController extends Controller
{
    public function make_transaction(Request $request){
        //dd(Auth::id());
        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            'service' => 'required|string|max:255'
        ]);

        $client = Client::where('user_id', Auth::id())->first();
        try {
            $transaction = Transaction::create([
                'amount' => $request->amount,
                'description' => $request->description,
                'client_id' => $client->id,
                'service' => $request->service,

            ]);

            return response()->json([
                'message' => 'Transação criada com sucesso',
                'data' => $transaction
            ], 201);

        } catch (QueryException $e) {

            return response()->json([
                'message' => 'Erro ao criar transação',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function list_my_transaction(){
        $transactions = Transaction::whereHas('client', function($query){
            $query->where('user_id', Auth::id());
        })->get();

        return response()->json([
            'data' => $transactions
        ]);
    }

    public function view_details($id){
        $transaction = Transaction::whereHas('client', function($query){
            $query -> where('user_id',Auth::id());
        })->first();

        if(!$transaction){
            return response()->json([
                'message' => 'Transação não encontrada'
            ],404);
        }

        return response()->json([
            'data' => $transaction
        ]);
    }

    public function cancel_transaction($id){
        $transaction = Transaction::where('id',$id)
                        ->where('client_id',Auth::id())
                        ->first();

        if(!$transaction){
            return response()->json([
                'message' => 'Transação não encontrada'
            ],404);
        }

        $transaction->delete();

        return response()->json([
            'message' => 'Transação cancelada'
        ]);
    }
}