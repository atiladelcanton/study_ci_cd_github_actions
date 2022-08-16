<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new Product;
        return $products->all()->where('status', 'Ativo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validate = $request->validated();
        return Product::create($validate);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Produto não encontrado',
                'status'  => 404
            ], 404);
        }

        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $idProduct)
    {
        $product = Product::findOrFail($idProduct);

        $product->update($request->all());

        return response()->json([
            'message' => 'Produto atualizado com sucesso',
            'status'  => 200,
            'product' => $product->id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'status' => 'inactive'
        ]);

        return response()->json([
            'message' => 'Produto removido com sucesso',
            'status'  => 200,
            'product' => $product->id
        ], 200);
    }
}
