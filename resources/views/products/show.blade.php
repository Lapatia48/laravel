@extends('layouts.app')

@section('title', $product->name . ' - Détails')
@section('page-title', 'Détails du produit')

@section('content')
    <div class="container">
        <div class="product-detail-card">
            <div class="header">
                <h1>{{ $product->name }}</h1>
                <div class="meta-info">
                    <span class="slug-badge">{{ $product->slug }}</span>
                    <span class="price-badge">{{ number_format($product->price, 2, ',', ' ') }} €</span>
                    <span class="status-badge {{ $product->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $product->is_active ? 'Actif' : 'Inactif' }}
                    </span>
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">Description</div>
                <div class="section-content">
                    @if(!empty($product->description))
                        {{ $product->description }}
                    @else
                        <span class="empty-content">Aucune description fournie pour ce produit</span>
                    @endif
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">Catégorie</div>
                <div class="section-content">
                    @if($product->category)
                        <div class="category-info">
                            <strong>{{ $product->category->name }}</strong>
                            @if($product->category->description)
                                <p class="category-description">{{ $product->category->description }}</p>
                            @endif
                        </div>
                    @else
                        <span class="empty-content">Non catégorisé</span>
                    @endif
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">Informations</div>
                <div class="section-content">
                    <p><strong>Créé le :</strong> {{ $product->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Dernière mise à jour :</strong> {{ $product->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <div class="actions">
                <a href="{{ route('products.index') }}" class="btn btn-back">
                    Retour à la liste
                </a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-edit">
                    Éditer
                </a>
                <form method="POST" action="{{ route('products.destroy', $product) }}" 
                      class="delete-form" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .product-detail-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #3498db, #2c3e50);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .meta-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .slug-badge {
            background: linear-gradient(90deg, #e3f2fd, #bbdefb);
            color: #1976d2;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .price-badge {
            background: linear-gradient(90deg, #d1fae5, #a7f3d0);
            color: #065f46;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
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
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            color: #4a5568;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 5px;
        }
        
        .section-content {
            color: #2d3748;
            font-size: 1.1rem;
            line-height: 1.8;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .empty-content {
            color: #a0aec0;
            font-style: italic;
        }
        
        .category-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .category-description {
            color: #6b7280;
            font-size: 1rem;
            margin-top: 5px;
        }
        
        .actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 40px;
        }
        
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-back {
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }
        
        .btn-back:hover {
            background: #e9ecef;
        }
        
        .btn-edit {
            background: #e3f2fd;
            color: #1976d2;
            border: 1px solid #bbdefb;
        }
        
        .btn-edit:hover {
            background: #bbdefb;
        }
        
        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        
        .btn-delete:hover {
            background: #fecaca;
        }
        
        .delete-form {
            display: inline;
        }
        
        @media (max-width: 768px) {
            .product-detail-card {
                padding: 25px;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .meta-info {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }
            
            .actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
@endsection