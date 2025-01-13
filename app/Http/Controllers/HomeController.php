<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function pay(Request $request){
        $response = '';
        DB::transaction(function() use($request, &$response) { 
            $transaksi = \App\Models\Transaksi::create([
                'kode'   => 'INV' . mt_rand(100000, 999999),
                'product_id'=> $request->product_id,
                'harga'  => $request->harga,
                'status' => "pending",
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id'     => $transaksi->kode,
                    'gross_amount' => $transaksi->harga,
                ],
                'customer_details' => [
                    'first_name' => "Devan",
                    'email'      => "devan@gmail.com",
                ],
                'item_details' => [
                    [
                        'id'            => $transaksi->produk_id,
                        'price'         => $transaksi->harga,
                        'quantity'      => 1,
                        'name'          => 'barang',
                        'brand'         => 'nama_brand',
                        'category'      => 'bebas',
                        'merchant_name' => 'latihan',
                    ],
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $transaksi->snap_token = $snapToken;
            $transaksi->save();

            $response = $snapToken;
        });
        
        return response()->json([
            'status'     => 'success',
            'snap_token' => $response,
        ]);
    }

    public function index()
    {
        $data = [
            'products' => Product::all(),
        ];

        return view('home', $data);
    }

    public function pay_success(request $request)
    {
        // dd($request->snap_token);
        DB::table('transaksis')->where('snap_token', $request->snap_token)->update([
            'status' => 'success',
        ]);

        return redirect('/home');
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
        //
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
