<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return SaleResource::collection(Sale::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSaleRequest $request)
    {
        $dataSale = $request->validated();

        $sale = Sale::create($dataSale);

        return response()->json([
            'message' => 'Venda realizada com sucesso.',
            'sale'    => $sale->id
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $sale = Sale::where('id', $id)->first();

        if (!$sale) {
            return response()->json([
                'error' => 'Não foi possível encontrar a venda.'
            ], 404);
        }

        return response()->json(new SaleResource($sale), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Sale $pedido
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSaleRequest $request, Sale $pedido)
    {
        $product = Product::where('id', $pedido->product_id)->first();

        $previousStock = $product->stock + $pedido->quantity;

        if ($previousStock < $request->quantity) {
            return response()->json([
                'error' => 'Não há estoque suficiente para a venda.'
            ], 400);
        }

        $product->update([
            'stock' => $previousStock - $request->quantity
        ]);

        $pedido->update($request->all());

        return response()->json([
            'message' => 'Venda alterada com sucesso.',
            'sale'    => $pedido->id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Sale $pedido
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Sale $pedido)
    {
        if ($pedido->status == 'Pago') {
            return response()->json([
                'message' => 'Não é possível cancelar um pedido já pago.'
            ], 400);
        }

        $pedido->delete();

        return response()->json([
            'message' => 'Venda cancelada com sucesso.'
        ], 200);
    }

    public function changeStatus(Request $request, $id)
    {
        $sale = Sale::where('id', $id)->first();

        if (!$sale) {
            return response()->json([
                'error' => 'Não foi possível encontrar a venda.'
            ], 404);
        }

        if ($sale->status == 'Pago') {
            return response()->json([
                'message' => 'Não é possível alterar o status de um pedido já pago.'
            ], 400);
        }

        $sale->update($request->all());

        return response()->json([
            'message' => 'Status alterado com sucesso.',
            'sale'    => $sale->id
        ], 200);
    }
}
