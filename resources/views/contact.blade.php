@extends('layouts.app')

@section('title', 'Contact')
@section('page-title', 'Contactez-nous')

@section('content')
    <div class="contact-container">
        <div class="contact-card">
            <h1>Contactez-nous</h1>
            <p class="contact-description">
                Vous avez des questions ou des suggestions ? N'hésitez pas à nous contacter.
            </p>
            
            <div class="contact-info">
                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>{{ $email }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">📍</div>
                    <div class="info-content">
                        <h3>Adresse</h3>
                        <p>123 Rue du Marketplace<br>75000 Paris, France</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">📞</div>
                    <div class="info-content">
                        <h3>Téléphone</h3>
                        <p>+33 1 23 45 67 89</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .contact-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .contact-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .contact-card h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: linear-gradient(90deg, #3498db, #2c3e50);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .contact-description {
            color: #5d6d7e;
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 40px;
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .info-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .info-item:hover {
            transform: translateY(-5px);
            border-color: #3498db;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .info-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .info-content h3 {
            color: #2c3e50;
            font-size: 1.3rem;
            margin-bottom: 10px;
        }
        
        .info-content p {
            color: #7f8c8d;
            line-height: 1.6;
        }
        
        @media (max-width: 768px) {
            .contact-card {
                padding: 25px;
            }
            
            .contact-card h1 {
                font-size: 2rem;
            }
            
            .contact-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection