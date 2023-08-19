<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TransportSubmodeResource;
use App\Models\TransportSubmode;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return successResponseJson(ProductResource::collection($products));

    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return successResponseJson(new ProductResource($product));
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return successResponseJson(new ProductResource($product), 'Product created successfully');
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return successResponseJson(new ProductResource($product), 'Product updated successfully');

    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return successResponseJson('Product information deleted');
    }


    public function calculateTransportPrice(Request $request, $product_id, $submode_id)
    {
        $request->validate([
            'distance' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($product_id);
        $submode = TransportSubmode::findOrFail($submode_id);

        // Calculate price based on distance and cost_per_km
        $distance = $request->input('distance');
        $price = $distance * $submode->cost_per_km * $product->weight;

        return successResponseJson(['product' => new ProductResource($product), 'submode' => new TransportSubmodeResource($submode), 'distance' => $distance, 'price' => $price]);
    }
}
