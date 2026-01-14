<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\AddCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return response()->json([
            'message' => 'ok',
            'data' => $categories
        ], 200);
    }

    public function show(Category $category)
    {
        return response()->json([
            'message' => 'ok',
            'data' => $category
        ], 200);
    }

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

    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $data  = $request->validated();

        if (isset($data['name'])) {
            $data['name'] = Str::lower($data['name']);
        }

        $category->update($data);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category->refresh()
        ], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
