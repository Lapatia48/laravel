@extends('layouts.app')

@section('title', 'Ajouter un produit')
@section('page-title', 'Créer un produit')

@section('content')
    <div class="container">
        <div class="form-card">
            <h1>📦 Ajouter un produit</h1>
            
            <form method="POST" action="{{ route('products.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nom du produit *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           class="form-control" 
                           value="{{ old('name') }}" 
                           required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="slug">Slug *</label>
                    <input type="text" 
                           name="slug" 
                           id="slug" 
                           class="form-control" 
                           value="{{ old('slug') }}" 
                           required>
                    <small style="color: #6b7280; font-size: 0.9rem;">
                        Version URL-friendly (ex: "ordinateur-portable")
                    </small>
                    @error('slug')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" 
                              id="description" 
                              class="form-control">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="price">Prix (€) *</label>
                    <input type="number" 
                           name="price" 
                           id="price" 
                           class="form-control" 
                           value="{{ old('price') }}" 
                           step="0.01"
                           min="0"
                           required>
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="category_id">Catégorie *</label>
                    <select name="category_id" 
                            id="category_id" 
                            class="form-control"
                            required>
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" 
                               name="is_active" 
                               id="is_active" 
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="is_active">Produit actif</label>
                    </div>
                    @error('is_active')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-actions">
                    <a href="{{ route('products.index') }}" class="btn btn-cancel">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-submit">
                        Créer le produit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #2c3e50;
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 30px;
            background: linear-gradient(90deg, #3498db, #2c3e50);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a5568;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        select.form-control {
            cursor: pointer;
        }
        
        input[type="number"] {
            -moz-appearance: textfield;
        }
        
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        
        .error {
            color: #dc2626;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            gap: 15px;
        }
        
        .btn {
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }
        
        .btn-submit {
            background: linear-gradient(90deg, #3498db, #2980b9);
            color: white;
            flex: 1;
        }
        
        .btn-submit:hover {
            background: linear-gradient(90deg, #2980b9, #1c6ea4);
        }
        
        .btn-cancel {
            background: #f8f9fa;
            color: #495057;
            border: 1px solid #dee2e6;
        }
        
        .btn-cancel:hover {
            background: #e9ecef;
        }
        
        @media (max-width: 768px) {
            .form-card {
                padding: 25px;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
@endsection