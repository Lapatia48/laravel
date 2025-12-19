<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->with(['products' => function($query) {
                $query->select('id', 'name', 'price', 'category_id', 'is_active')
                    ->where('is_active', true)
                    ->limit(5);
            }])
            ->orderBy('name')
            ->get();
        
        return view('categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        
        $validated['is_active'] = (bool) $request->input('is_active', false);
        
        Category::create($validated);
        
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès !');
    }

    public function show(Category $category)
    {
        $category->load(['products' => function($query) {
            $query->select('id', 'name', 'slug', 'price', 'description', 'is_active', 'created_at')
                ->orderBy('created_at', 'desc');
        }]);
        
        return view('categories.show', ['category' => $category]);
    }

    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        
        $validated['is_active'] = (bool) $request->input('is_active', false);
        
        $category->update($validated);
        
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès !');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès !');
    }
}