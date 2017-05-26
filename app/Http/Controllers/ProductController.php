<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panel\Product;

class ProductController extends Controller
{

    private $product;

    public function __construct(Product $product)
    {
        $this->middleware('auth');
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();
        return view('panel.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create new product";
        return view('panel.products.create');
    }

    /**
     * Creating a new random resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        $this->product->insert([
            "name" => "Product ". rand(0,9999),
            "price" => rand(1,99),
            "stock_quantity" => rand(10,50)
        ]);
        return redirect()->route('product.index')->with('success', 'Random product created with success.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();

        // Validation
        $this->validate($request, $this->product->rules);

        if ($this->product->create($dataForm))
            return redirect()->route('product.index')->with('success', 'Product created with success.');
        else
            return redirect()->route('product.create')->with('error', 'Product creation error.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);
        $title = "Edit product: {$product->name}";

        return view('panel.products.create-edit', compact('title', 'product'));
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
        $dataForm = $request->all();
        $product = $this->product->find($id);
        $update = $product->update($dataForm);

        if ($update)
            return redirect()->route('product.edit', $id)->with('success', 'Product edited with success.');
        else
            return redirect()->route('product.create-edit')->with('error', 'Product edition error.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product->find($id)->delete();
        return redirect()->route('product.index');
    }
}
