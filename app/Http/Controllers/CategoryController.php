<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Affiche la liste des catégories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('categories.create');
    }

    // Enregistre une nouvelle catégorie
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        
        // S'assurer que is_active est bien un boolean
        $validated['is_active'] = (bool) $request->input('is_active', false);
        
        Category::create($validated);
        
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès !');
    }

    // Affiche une catégorie spécifique (READ)
    public function show(Category $category)
    {
        return view('categories.show', ['category' => $category]);
    }

    // Affiche le formulaire d'édition
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    // Met à jour une catégorie
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);
        
        // S'assurer que is_active est bien un boolean
        $validated['is_active'] = (bool) $request->input('is_active', false);
        
        $category->update($validated);
        
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès !');
    }

    // Supprime une catégorie
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès !');
    }
}