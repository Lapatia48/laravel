<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category' => function($query) {
            $query->select('id', 'name', 'slug', 'is_active');
        }]);
        
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($request->sort == 'name_desc') {
                $query->orderBy('name', 'desc');
            } elseif ($request->sort == 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        $products = $query->paginate(12);
        
        $categories = Category::withCount(['products' => function($query) {
        }])->get(['id', 'name', 'slug', 'is_active']);
        
        $activeCategory = null;
        if ($request->filled('category')) {
            $activeCategory = Category::where('slug', $request->category)
                ->select('id', 'name', 'slug', 'description')
                ->first();
        }
        
        return view('products.index', compact('products', 'categories', 'activeCategory'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->select('id', 'name')
            ->get();
        
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        
        $validated['is_active'] = (bool) $request->input('is_active', false);
        
        Product::create($validated);
        
        return redirect()->route('products.index')
            ->with('success', 'Produit créé avec succès !');
    }

    public function show(Product $product)
    {
        $product->load(['category' => function($query) {
            $query->select('id', 'name', 'slug', 'description');
        }]);
        
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load(['category' => function($query) {
            $query->select('id', 'name');
        }]);
        
        $categories = Category::where('is_active', true)
            ->select('id', 'name')
            ->get();
        
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        
        $validated['is_active'] = (bool) $request->input('is_active', false);
        
        $product->update($validated);
        
        return redirect()->route('products.index')
            ->with('success', 'Produit mis à jour avec succès !');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé avec succès !');
    }
}