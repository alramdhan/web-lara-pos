<?php

namespace App\Http\Controllers\API;

use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.quantity' => 'required|integer|min:1',
            'pay_amount' => 'required|numeric',
            'payment_method' => 'required|in:cash,qris,transfer',
            'nama_pelanggan' => 'required|string'
        ]);

        if($validator->fails())
        {
            return $this->sendError('failed validation', $validator->errors(), 422);
        }

        try {
            DB::beginTransaction();
            $totalAmount = 0;
            $trxItemsData = [];

            foreach($request->items as $item) {
                $product = Produk::lockForUpdate()->find($item['produk_id']);

                if ($product->stok < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi.");
                }

                $subtotal = $product->harga * $item['quantity'];
                $totalAmount += $subtotal;

                $product->decrement('stok', $item['quantity']);
                $product->increment('hitungan_terjual', $item['quantity']);

                $transactionItemsData[] = [
                    'produk_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->harga,
                    'subtotal' => $subtotal,
                ];
            }

            if ($request->pay_amount < $totalAmount) {
                throw new \Exception("Uang pembayaran kurang.");
            }

            $transaction = Transaction::create([
                'trx_invoice' => 'INV-' . time() . '-' . Str::random(4),
                'user_id' => Auth::id(),
                'total_belanja' => $totalAmount,
                'pay_amount' => $request->pay_amount,
                'change_amount' => $request->pay_amount - $totalAmount,
                'status_pembayaran' => 'paid',
                'metode_pembayaran' => $request->payment_method
            ]);
            
            foreach ($transactionItemsData as &$data) {
                $data['transaction_id'] = $transaction->id;
            }
            
            TransactionItem::insert($transactionItemsData);

            DB::commit();

            return $this->sendResponse($transaction->load(['items.produk', 'cashier']), "transaksi_berhasil", $code = 201);
        } catch(\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
