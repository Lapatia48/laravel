<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupère tous les produits avec leurs catégories
        $products = Product::with('category')->paginate(10);
        
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupère toutes les catégories actives
        $categories = Category::where('is_active', true)->get();
        
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Validation effectuée dans StoreProductRequest
        $validated = $request->validated();
        
        // S'assurer que is_active est bien un boolean
        $validated['is_active'] = (bool) $request->input('is_active', false);
        
        Product::create($validated);
        
        return redirect()->route('products.index')
            ->with('success', 'Produit créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Charge la catégorie avec le produit
        $product->load('category');
        
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Récupère toutes les catégories actives
        $categories = Category::where('is_active', true)->get();
        
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Validation effectuée dans UpdateProductRequest
        $validated = $request->validated();
        
        // S'assurer que is_active est bien un boolean
        $validated['is_active'] = (bool) $request->input('is_active', false);
        
        $product->update($validated);
        
        return redirect()->route('products.index')
            ->with('success', 'Produit mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('products.index')
            ->with('success', 'Produit supprimé avec succès !');
    }
}