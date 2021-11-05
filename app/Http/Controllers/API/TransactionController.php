<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;
use App\Models\Transaction;
use App\Models\TransactionItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request){
        $id = $request->input('id');
        $limit = $request->input('limit',6);
        $status = $request->input('status');

        if($id) {
            $transaction = Transaction::with(['items.product']) ->find($id);
            if($transaction){
                return ResponseFormatter::success(
                    $transaction,
                    'Data transaksi berhasil diambil'
                );
            }
            else {
                return ResponseFormatter::error([
                   null,
                   'Data Transaksi Tidak ada',
                   404 
                ]);
            }
        }
        $transaction = Transaction::with(['items.product'])->where('user_id', Auth::user()->id);
         
        if($status){
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data List Transaction Berhasil diambil'
        );
    }

    public function checkout(Request $request){
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'exists:products,id',
            'total_price' => 'required',
            'atas_nama' => 'required',
            'status' => 'required|in:PENDING,SUCCESS'
        ]);

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'atas_nama' => $request->atas_nama,
            'no_meja' => $request->no_meja,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        foreach ($request->items as $product) {
            TransactionItems::create([
            'users_id' => Auth::user()->id,
            'products_id' => $product['id'],
            'transaction_id' => $transaction->id,
            'quantity' => $product['quantity']
            ]);
        }

        return ResponseFormatter::success($transaction->load('items.product'), 'Transaksi berhasil'); 
    }
}
