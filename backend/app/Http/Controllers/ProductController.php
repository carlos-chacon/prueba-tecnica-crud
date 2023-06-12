<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FunctionHelper;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $numberPage = 10;

    public function index()
    {
        $products = Product::paginate($this->numberPage);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $this->validate($request, FunctionHelper::requestValidationProduct());

        $datos = $request->all();

        $product = new Product;
        $product->fill($datos);
        $product->save();

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, FunctionHelper::requestValidationProduct());

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $datos = $request->all();

        $product->fill($datos);
        $product->save();

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
