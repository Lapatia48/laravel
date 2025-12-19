@extends('layouts.app')

@section('title', 'À propos')
@section('page-title', 'À propos de nous')

@section('content')
    <div class="about-container">
        <div class="about-card">
            <h1>À propos de Laravel Marketplace</h1>
            <p class="about-description">
                Bienvenue sur notre plateforme de gestion de marketplace construite avec Laravel.
                Cette application démontre les fonctionnalités CRUD complètes avec une interface utilisateur moderne.
            </p>
            
            <div class="features">
                <h2>Fonctionnalités principales</h2>
                <ul>
                    <li>Gestion complète des catégories (CRUD)</li>
                    <li>Interface responsive et moderne</li>
                    <li>Sidebar de navigation intuitive</li>
                    <li>Système de validation robuste</li>
                    <li>Design marketplace élégant</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        .about-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .about-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .about-card h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #3498db, #2c3e50);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .about-description {
            color: #5d6d7e;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        
        .features h2 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        
        .features ul {
            list-style: none;
            padding-left: 0;
        }
        
        .features li {
            padding: 10px 0;
            color: #5d6d7e;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .features li:before {
            content: "•";
            color: #3498db;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .about-card {
                padding: 25px;
            }
            
            .about-card h1 {
                font-size: 2rem;
            }
        }
    </style>
@endsection