<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $request->file('image')->store('image_products', 'public');

                $product->update(['image' => $path]);
            }

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


    public function update(UpdateProductRequest $request, $id)
    {
        $product = DB::transaction(function () use ($request, $id) {
            $product = Product::findOrFail($id);

            $product->update([
                'name' => $request->name ?? $product->name,
                'slug' => $request->name
                    ? Str::slug($request->name)
                    : $product->slug,
                'description' => $request->description ?? $product->description,
                'category_id' => $request->category_id ?? $product->category_id
            ]);

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                $path = $request->file('image')->store('image_products', 'public');

                $product->update(['image' => $path]);
            }

            if ($request->filled('variants')) {
                foreach ($request->variants as $variant) {
                    $product->variants()->updateOrCreate(
                        ['id' => $variant['id'] ?? null],
                        [
                            'size' => isset($variant['size'])
                                ? Str::lower($variant['size'])
                                : null,
                            'stock' => $variant['stock'],
                            'price' => $variant['price'],
                            'weight' => $variant['weight'],
                        ]
                    );
                }
            }

            if ($request->filled('product_attributes')) {
                foreach ($request->product_attributes as $attr) {
                    $product->attributes()->updateOrCreate(
                        ['id' => $attr['id'] ?? null],
                        $attr
                    );
                }
            }

            return $product->load(['variants', 'attributes']);
        });

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    }

    public function destroy(Product $category) {
        
    }
}
