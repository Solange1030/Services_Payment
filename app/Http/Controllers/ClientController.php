<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    //

    public function make_transaction(Request $request){
        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255'
        ]);

        $transaction = Transaction::create([
            'amount' => $request->amount,
            'description' => $request->description,
            'client_id' => Auth::id()
        ]);

        return response()->json([
            'message' => 'Transação criada com sucesso',
            'data' => $transaction
        ],201);
    }

    public function list_my_transaction(){

        $transactions = Transaction::where('client_id', Auth::id())->get();

        return response()->json([
            'data' => $transactions
        ]);
    }

    public function view_details($id){

        $transaction = Transaction::where('id',$id)
                        ->where('client_id',Auth::id())
                        ->first();

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
