@extends('layouts.app')

@section('title', 'Produits - Marketplace')
@section('page-title', 'Gestion des produits')

@section('content')
    <div class="marketplace-container">
        <div class="marketplace-header">
            <h1>📦 Marketplace Products</h1>
            <p class="marketplace-subtitle">
                @if(count($products) > 0)
                    {{ $products->total() }} produit(s) disponible(s)
                    @if(request()->filled('category') && $activeCategory)
                        dans la catégorie "{{ $activeCategory->name }}"
                    @endif
                @else
                    Commencez par ajouter des produits
                @endif
            </p>
        </div>
        
        <!-- Filtres et Recherche -->
        <div class="filters-section">
            <div class="filters-container">
                <!-- Formulaire de recherche -->
                <form method="GET" action="{{ route('products.index') }}" class="search-form">
                    <div class="search-input-group">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Rechercher un produit..." 
                               class="search-input">
                        <button type="submit" class="search-button">
                            🔍
                        </button>
                    </div>
                </form>
                
                <!-- Filtres et Tris -->
                <div class="filters-row">
                    <!-- Filtre par catégorie -->
                    <div class="filter-group">
                        <span class="filter-label">Catégorie :</span>
                        <div class="category-filters">
                            <a href="{{ route('products.index') }}" 
                               class="category-filter {{ !request()->filled('category') ? 'active' : '' }}">
                                Toutes ({{ $categories->sum('products_count') }})
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                                   class="category-filter {{ request('category') == $category->slug ? 'active' : '' }}">
                                    {{ $category->name }} ({{ $category->products_count }})
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Tri des produits -->
                    <div class="filter-group">
                        <span class="filter-label">Trier par :</span>
                        <form method="GET" action="{{ route('products.index') }}" class="sort-form">
                            @if(request()->filled('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request()->filled('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                            <select name="sort" onchange="this.form.submit()" class="sort-select">
                                <option value="">Sélectionner</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                    Prix croissant
                                </option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    Prix décroissant
                                </option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                    Nom A-Z
                                </option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                    Nom Z-A
                                </option>
                            </select>
                        </form>
                    </div>
                </div>
                
                <!-- Reset filters -->
                @if(request()->filled('category') || request()->filled('search') || request()->filled('sort'))
                    <div class="reset-filters">
                        <a href="{{ route('products.index') }}" class="reset-link">
                            ✖ Réinitialiser tous les filtres
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Affichage des résultats -->
        @if(request()->filled('search') && count($products) > 0)
            <div class="search-results-info">
                <p>Résultats pour "<strong>{{ request('search') }}</strong>" : {{ $products->total() }} produit(s) trouvé(s)</p>
            </div>
        @endif
        
        <div class="categories-grid">
            @forelse($products as $product)
                <div class="category-card">
                    <div class="category-header">
                        <div class="category-name">
                            <span>{{ $product->name }}</span>
                        </div>
                        <span class="category-slug">{{ $product->slug }}</span>
                    </div>
                    
                    <div class="category-body">
                        <p class="category-description">
                            @if(!empty($product->description))
                                {{ Str::limit($product->description, 100) }}
                            @else
                                <span style="color: #bdc3c7; font-style: italic;">
                                    Aucune description fournie pour ce produit
                                </span>
                            @endif
                        </p>
                        
                        <div class="product-details">
                            <div class="product-price">
                                <strong>{{ number_format($product->price, 0, ',', ' ') }} Ar</strong>
                            </div>
                            @if($product->category)
                                <div class="product-category">
                                    <span class="category-tag">{{ $product->category->name }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="category-footer">
                        <span class="category-status {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        
                        <div class="category-actions">
                            <a href="{{ route('products.show', $product) }}" class="action-btn view-btn">
                                Voir
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="action-btn edit-btn">
                                Éditer
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}" 
                                  class="delete-form" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">📦</div>
                    <h3>Aucun produit trouvé</h3>
                    <p>
                        @if(request()->filled('search'))
                            Aucun produit ne correspond à votre recherche "{{ request('search') }}"
                        @elseif(request()->filled('category'))
                            Aucun produit dans cette catégorie
                        @else
                            Commencez par ajouter votre premier produit à votre marketplace
                        @endif
                    </p>
                    @if(request()->filled('search') || request()->filled('category'))
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            Voir tous les produits
                        </a>
                    @endif
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="pagination">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif
        
        <div class="add-category-container">
            <a href="{{ route('products.create') }}" class="add-btn">
                Ajouter un nouveau produit
            </a>
        </div>
    </div>

    <style>
        .marketplace-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .marketplace-header {
            text-align: center;
            margin-bottom: 30px;
            padding: 30px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .marketplace-header h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #3498db, #2c3e50);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .marketplace-subtitle {
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        
        /* Filtres Section */
        .filters-section {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        
        .filters-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        /* Recherche */
        .search-form {
            margin-bottom: 10px;
        }
        
        .search-input-group {
            display: flex;
            gap: 10px;
            max-width: 500px;
        }
        
        .search-input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .search-button {
            padding: 12px 24px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            transition: background-color 0.2s;
        }
        
        .search-button:hover {
            background: #2980b9;
        }
        
        /* Filtres Row */
        .filters-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .filter-label {
            font-weight: 600;
            color: #4a5568;
            white-space: nowrap;
        }
        
        /* Filtres par catégorie */
        .category-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .category-filter {
            padding: 8px 16px;
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .category-filter:hover {
            background: #e9ecef;
            border-color: #adb5bd;
        }
        
        .category-filter.active {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }
        
        /* Tri */
        .sort-form {
            display: inline-block;
        }
        
        .sort-select {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            font-size: 0.95rem;
            color: #4a5568;
            cursor: pointer;
            min-width: 180px;
        }
        
        .sort-select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        /* Reset filters */
        .reset-filters {
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
        }
        
        .reset-link {
            color: #dc2626;
            text-decoration: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .reset-link:hover {
            text-decoration: underline;
        }
        
        /* Search results info */
        .search-results-info {
            background: #e3f2fd;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
            color: #1976d2;
            border-left: 4px solid #1976d2;
        }
        
        /* Products Grid */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .category-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
        }
        
        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }
        
        .category-header {
            padding: 25px 25px 15px;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .category-name {
            color: #2c3e50;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .category-slug {
            display: inline-block;
            background: linear-gradient(90deg, #e3f2fd, #bbdefb);
            color: #1976d2;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 5px;
        }
        
        .category-body {
            padding: 20px 25px;
        }
        
        .category-description {
            color: #5d6d7e;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 15px;
        }
        
        .product-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f1f1f1;
        }
        
        .product-price {
            color: #28a745;
            font-size: 1.3rem;
            font-weight: 700;
        }
        
        .category-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .category-footer {
            padding: 15px 25px 25px;
            border-top: 1px solid #f1f1f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .category-status {
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-active {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .category-actions {
            display: flex;
            gap: 10px;
        }
        
        .action-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        .view-btn {
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }
        
        .view-btn:hover {
            background: #e9ecef;
        }
        
        .edit-btn {
            background: #e3f2fd;
            color: #1976d2;
            border: 1px solid #bbdefb;
        }
        
        .edit-btn:hover {
            background: #bbdefb;
        }
        
        .delete-btn {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        
        .delete-btn:hover {
            background: #fecaca;
        }
        
        .delete-form {
            display: inline;
        }
        
        .add-category-container {
            text-align: center;
            margin-top: 50px;
            padding: 40px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .add-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: linear-gradient(90deg, #3498db, #2980b9);
            color: white;
            padding: 16px 40px;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }
        
        .add-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(52, 152, 219, 0.4);
        }
        
        .add-btn:before {
            content: "+";
            font-size: 1.5rem;
            font-weight: 300;
        }
        
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 40px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #bdc3c7;
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            color: #7f8c8d;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        
        .empty-state p {
            color: #95a5a6;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        
        .btn-primary {
            background: #3498db;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
        }
        
        .btn-primary:hover {
            background: #2980b9;
        }
        
        .pagination {
            padding: 20px;
            display: flex;
            justify-content: center;
            background: white;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        
        .pagination ul {
            display: flex;
            gap: 10px;
            list-style: none;
        }
        
        .pagination li a {
            padding: 10px 15px;
            border-radius: 8px;
            background: #f8f9fa;
            color: #495057;
            text-decoration: none;
            border: 1px solid #dee2e6;
            transition: all 0.2s ease;
        }
        
        .pagination li a:hover {
            background: #e9ecef;
        }
        
        .pagination li.active a {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }
        
        @media (max-width: 768px) {
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .marketplace-header h1 {
                font-size: 2rem;
            }
            
            .filters-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .filter-group {
                width: 100%;
            }
            
            .category-filters {
                overflow-x: auto;
                padding-bottom: 10px;
            }
            
            .category-card {
                margin: 0 10px;
            }
            
            .category-footer {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            
            .category-status {
                align-self: flex-start;
            }
            
            .category-actions {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
        
        @media (max-width: 480px) {
            .marketplace-header,
            .add-category-container {
                padding: 20px 15px;
            }
            
            .filters-section {
                padding: 20px;
            }
            
            .category-header,
            .category-body,
            .category-footer {
                padding: 20px 15px;
            }
        }
    </style>
@endsection