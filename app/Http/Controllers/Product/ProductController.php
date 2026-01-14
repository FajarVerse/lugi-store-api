<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function store(AddProductRequest $request)
    {
        $product = DB::transaction(function () use ($request) {
            $product = Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);

            if ($request->variants) {
                foreach ($request->variants as $variant) {
                    $product->variants()->create($variant);
                }
            }

            if ($request->product_attributes) {
                foreach ($request->product_attributes as $attr) {
                    $product->attributes()->create($attr);
                }
            }

            return $product->load(['variants', 'attributes']);
        });

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }
}
