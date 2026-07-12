<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class OrderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::with('transactions')->latest()->take(10)->get();
        $totalOrders = Order::count();
        $todayOrders = Order::whereDate('created_at', today())->count();
        $totalRevenue = Transaction::sum('transaction_amount');
        $totalProducts = Product::count();
        $order_receipt = collect();

        return view('orders.index', compact('products', 'orders', 'totalOrders', 'todayOrders', 'totalRevenue', 'totalProducts', 'order_receipt'));
    }

    public function list()
    {
        $orders = Order::with('orderDetails.product')->latest()->paginate(15);
        return view('orders.list', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all(); 

        DB::transaction(function () use ($request) {
            //Order Model
            $orders = new Order;
            $orders->name = $request->customerName;
            $orders->mobile = $request->customerMobile;
            $orders->save();
            $order_id =  $orders->id;  

            //Order Details
            for($product_id = 0; $product_id < count($request->product_id); $product_id++){
                $order_details = new Order_detail;
                $order_details->order_id = $order_id;
                $order_details->product_id  = $request->product_id[$product_id];
                $order_details->unitprice  = $request->price[$product_id];
                $order_details->quantity  = $request->quantity[$product_id];
                $order_details->discount  = $request->discount[$product_id];
                $order_details->amount  = $request->total_amount[$product_id];
                $order_details->save();
            }

            //Transaction
            $transaction = new Transaction();
            $transaction->order_id = $order_id;
            $transaction->user_id = auth()->user()->id;
            $transaction->balance  = $request->balance;
            $transaction->paid_amount  = $request->paidAmount;
            $transaction->payment_method  = $request->paymentMethod;
            $transaction->transaction_amount  = $request->total;
            $transaction->transaction_date  = date('Y-m-d');
            $transaction->save(); 
        });
        return redirect()->back()->with('success', 'Product Order Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
