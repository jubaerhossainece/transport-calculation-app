<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

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
}
