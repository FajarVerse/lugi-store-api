<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\AddCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function store(AddCategoryRequest $request)
    {

        $categories = collect($request->validated()['categories'])
            ->map(fn($category) => [
                'name' => Str::lower($category['name']),
                'slug' => Str::slug($category['name']),
                'created_at' => now(),
                'updated_at' => now()
            ]);

        Category::insert($categories->toArray());

        $slugs = $categories->pluck('slug');

        $data = Category::whereIn('slug', $slugs)->get();

        return response()->json([
            'message' => 'Categories created successfully',
            'data' => $data
        ], 200);
    }
}
