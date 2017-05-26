<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panel\Order;
use App\Models\Panel\Product;
use App\Models\Panel\OrderProduct;
use DB;

class OrderController extends Controller
{
    private $order;
    private $product;
    private $orderProduct;

    public function __construct(Order $order, Product $product, OrderProduct $orderProduct)
    {
        $this->middleware('auth')->except("random");
        $this->order = $order;
        $this->product = $product;
        $this->orderProduct = $orderProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->order->orderBy("updated_at", 'desc')->get();
        return view('panel.orders.index', compact('orders'));
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
     * Creating a new random resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        DB::beginTransaction();

        // Generate new order
        $orderId = $this->order->insertGetId([]);
        $total_price = 0;

        // Get random products (maximum 5 products for demonstration)
        for ($i=0; $i <= rand(1,5); $i++) {
            $product = $this->product->where('stock_quantity', '>', 0)->inRandomOrder()->first();

            if ($product !== null){
                $equested_random_quantity = rand(1, ceil($product->stock_quantity / 2) );
                $product->update(['stock_quantity' => ($product->stock_quantity - $equested_random_quantity) ]);
                $total_price += $equested_random_quantity * $product->price;

                // Check for existence order with this product
                $checkExistence = $this->orderProduct->where([ ['order_id', '=', $orderId],['product_id', '=', $product->id] ])->first();

                if ( $checkExistence === null ){
                    $this->orderProduct->insert([
                        "order_id" => $orderId,
                        "product_id" => $product->id,
                        "quantity" => $equested_random_quantity
                    ]);
                }else{
                    $this->orderProduct
                         ->where('id', $checkExistence->id)
                         ->update(['quantity' => ($checkExistence->quantity + $equested_random_quantity) ]);
                }
            }
        }

        if ($total_price != 0){
            $this->order->where('id', $orderId)->update(['total_price' => $total_price]);
            DB::commit();
            return redirect()->route('order.index')->with('success', 'Order created with success.');
        }else{
            DB::rollBack();
            return redirect()->route('order.index')->with('error', 'No product available for random order generation.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('order.show', ['order' => $this->order->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->order->find($id)->delete();
        return redirect()->route('order.index')->with('success', 'Order deleted with success.');;
    }
}
