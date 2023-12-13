<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Resources\ProductsResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductsRequest;
use App\Traits\HttpResponces;


class ProductsController extends Controller
{

    use HttpResponces;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductsResource::collection(
            Products::where('user_id', Auth::user()->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        $request->validated($request->all());

        $product = Products::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'augstums' => $request->augstums,
            'garums' => $request->garums,
            'svars' => $request->svars,
        ]);
        
        return new ProductsResource($product);

        }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return $this->isNotAuthorized($product) ? $this->isNotAuthorized($product) : new ProductsResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        if(Auth::user()->id !== $product->user_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $product->update($request->all());

        return new ProductsResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        return $this->isNotAuthorized($product) ? $this->isNotAuthorized($product) : $product->delete();
    }

    private function isNotAuthorized($product) {
        if(Auth::user()->id !== $product->user_id){
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }

}
