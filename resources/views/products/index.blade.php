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
                @else
                    Commencez par ajouter des produits
                @endif
            </p>
        </div>
        
        <div class="table-container">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <strong>{{ $product->name }}</strong>
                                    <small class="product-slug">{{ $product->slug }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="product-price">{{ number_format($product->price, 2, ',', ' ') }} Ar</span>
                            </td>
                            <td>
                                @if($product->category)
                                    <span class="category-badge">
                                        {{ $product->category->name }}
                                    </span>
                                @else
                                    <span class="no-category">Non catégorisé</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ $product->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="empty-state">
                                    <div class="empty-state-icon">📦</div>
                                    <h3>Aucun produit trouvé</h3>
                                    <p>Commencez par ajouter votre premier produit</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            @if($products->hasPages())
                <div class="pagination">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
        
        <div class="add-product-container">
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
            margin-bottom: 40px;
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
        
        .table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .products-table th {
            background: linear-gradient(90deg, #f8f9fa, #e9ecef);
            color: #495057;
            font-weight: 600;
            padding: 20px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }
        
        .products-table td {
            padding: 20px;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .products-table tr:hover {
            background-color: #f8f9fa;
        }
        
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .product-slug {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .product-price {
            font-weight: 700;
            color: #28a745;
            font-size: 1.1rem;
        }
        
        .category-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .no-category {
            color: #6c757d;
            font-style: italic;
        }
        
        .status-badge {
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
        
        .action-buttons {
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
        
        .add-product-container {
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
            text-align: center;
            padding: 40px 20px;
        }
        
        .empty-state-icon {
            font-size: 3rem;
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
        }
        
        .pagination {
            padding: 20px;
            display: flex;
            justify-content: center;
            border-top: 1px solid #f1f1f1;
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
            .products-table {
                display: block;
                overflow-x: auto;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .marketplace-header h1 {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 480px) {
            .marketplace-header,
            .add-product-container {
                padding: 20px 15px;
            }
            
            .products-table th,
            .products-table td {
                padding: 15px 10px;
            }
        }
    </style>
@endsection