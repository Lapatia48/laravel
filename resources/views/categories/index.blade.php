@extends('layouts.app')

@section('title', 'Catégories - Marketplace')
@section('page-title', 'Gestion des catégories')

@section('content')
    <div class="marketplace-container">
        <div class="marketplace-header">
            <h1>Marketplace Categories</h1>
            <p class="marketplace-subtitle">
                @if(count($categories) > 0)
                    {{ count($categories) }} catégorie(s) disponible(s)
                @else
                    Commencez par ajouter des catégories
                @endif
            </p>
        </div>
        
        <div class="categories-grid">
            @forelse($categories as $category)
                <div class="category-card">
                    <div class="category-header">
                        <div class="category-name">
                            <span>{{ $category->name }}</span>
                        </div>
                        <span class="category-slug">{{ $category->slug }}</span>
                    </div>
                    
                    <div class="category-body">
                        <p class="category-description">
                            @if(!empty($category->description))
                                {{ $category->description }}
                            @else
                                <span style="color: #bdc3c7; font-style: italic;">
                                    Aucune description fournie pour cette catégorie
                                </span>
                            @endif
                        </p>
                    </div>
                    
                    <div class="category-footer">
                        <span class="category-status {{ $category->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        
                        <div class="category-actions">
                            <a href="{{ route('categories.show', $category) }}" class="action-btn view-btn">
                                Voir
                            </a>
                            <a href="{{ route('categories.edit', $category) }}" class="action-btn edit-btn">
                                Éditer
                            </a>
                            <form method="POST" action="{{ route('categories.destroy', $category) }}" 
                                  class="delete-form" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
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
                    <div class="empty-state-icon"></div>
                    <h3>Aucune catégorie trouvée</h3>
                    <p>Commencez par ajouter votre première catégorie à votre marketplace</p>
                </div>
            @endforelse
        </div>
        
        <div class="add-category-container">
            <a href="{{ route('categories.create') }}" class="add-btn">
                Ajouter une nouvelle catégorie
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
        }
        
        @media (max-width: 768px) {
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .marketplace-header h1 {
                font-size: 2rem;
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
            .marketplace-header {
                padding: 20px 15px;
            }
            
            .category-header,
            .category-body,
            .category-footer {
                padding: 20px 15px;
            }
        }
    </style>
@endsection