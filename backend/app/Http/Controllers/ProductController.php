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

        $q = request()->has('q') ? request()->get('q') : null;

        $products = Product::query();

        if ($q) {
            $products->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%")
                    ->orWhere('brand', 'like', "%{$q}%")
                    ->orWhere('created_at', 'like', "%{$q}%");
            });
        }

        $products->orderBy('created_at', 'desc');
        $resp = $products->paginate($this->numberPage);

        return response()->json($resp);
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
