<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Transaction;

class AdminController extends Controller
{
 
    public function list_clients()
    {
        $clients = Client::all();
        return response()->json([
            'success' => true,
            'clients' => $clients
        ]);
    }

 
    
    public function list_pending_transactions()
{
    $transactions = Transaction::with('client') 
        ->where('state', 'Pendente')
        ->get()
        ->map(function($tx) {
            return [
                'id' => $tx->id,
                'amount' => $tx->amount,
                'service' => $tx->service,
                'state' => $tx->state,
                'created_at' => $tx->created_at,
                'client_name' => $tx->client->name ?? '—', 
            ];
        });

    return response()->json([
        'success' => true,
        'pending_transactions' => $transactions
    ]);
}

public function list_faild_transactions()
{
    $transactions = Transaction::with('client')
        ->where('state', 'Falhado')
        ->get()
        ->map(function($tx) {
            return [
                'id' => $tx->id,
                'amount' => $tx->amount,
                'service' => $tx->service,
                'state' => $tx->state,
                'created_at' => $tx->created_at,
                'client_name' => $tx->client->name ?? '—',
            ];
        });

    return response()->json([
        'success' => true,
        'failed_transactions' => $transactions
    ]);
}

public function list_payed_transactions()
{
    $transactions = Transaction::with('client')
        ->where('state', 'Pago')
        ->get()
        ->map(function($tx) {
            return [
                'id' => $tx->id,
                'amount' => $tx->amount,
                'service' => $tx->service,
                'state' => $tx->state,
                'created_at' => $tx->created_at,
                'client_name' => $tx->client->name ?? '—',
            ];
        });

    return response()->json([
        'success' => true,
        'payed_transactions' => $transactions
    ]);
}


    
    public function view_transaction(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id'
        ]);

        $transaction = Transaction::find($request->transaction_id);

        return response()->json([
            'success' => true,
            'transaction' => $transaction
        ]);
    }

    
    public function cancel_transaction(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id'
        ]);

        $transaction = Transaction::find($request->transaction_id);
        $transaction->state = 'Falhado';
        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction canceled successfully.',
            'transaction' => $transaction
        ]);
    }

    
    public function update_transaction_state(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'state' => 'required|in:Pendente,Pago'
        ]);

        $transaction = Transaction::find($request->transaction_id);
        
        if ($transaction->state !== 'Pendente') {
            return response()->json([
                'success' => false,
                'message' => 'Somente transcoes pendentes podem ser actuailizadas.'
            ], 400);
        }

        $transaction->state = $request->state;
        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transacao actualizada co sucesso.',
            'transaction' => $transaction
        ]);
    }
}