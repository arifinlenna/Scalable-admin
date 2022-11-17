<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
// use App\Jobs\ProductCreated_aw;
use App\Jobs\ProductCreated_aw;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show(int $id)
    {
        return Product::find($id);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        ProductCreated::dispatch($product->toArray());
        // ProductCreated_aw::dispatch($product->toArray());
        return response($product, Response::HTTP_CREATED);
    }

    public function update($id, ProductRequest $request)
    {
        $product = Product::find($id);
        $product->update($request->all());
        ProductUpdated::dispatch($product->toArray());

        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destory($id)
    {
        Product::destory($id);
        ProductDeleted::dispatch($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
