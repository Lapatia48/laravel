<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Marketplace')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: #f8fafc;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #2c3e50 0%, #1a2530 100%);
            color: white;
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            border-right: 1px solid #1a2530;
        }
        
        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-section {
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .nav-title {
            padding: 0 20px 12px 20px;
            color: #a0aec0;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .nav-links {
            list-style: none;
        }
        
        .nav-item {
            margin: 4px 0;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #cbd5e0;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            border-radius: 4px;
            margin: 0 8px;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            border-left: 3px solid #3498db;
        }
        
        .nav-link.active {
            background: rgba(52, 152, 219, 0.1);
            color: white;
            border-left: 3px solid #3498db;
            border: 1px solid rgba(52, 152, 219, 0.2);
        }
        
        .sub-nav {
            list-style: none;
            margin-left: 20px;
            margin-top: 4px;
            border-left: 2px solid #3498db;
            background: #232e3a;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 2px 8px rgba(52,152,219,0.08);
            padding: 8px 0 8px 0;
            display: none;
            border: 1px solid rgba(52, 152, 219, 0.1);
        }
        
        .sub-nav.active {
            display: block;
        }
        
        .sub-nav .nav-link {
            padding: 8px 24px 8px 8px;
            font-size: 0.95rem;
            border-left: none;
            border-radius: 4px;
            margin: 2px 0;
        }
        
        .nav-link.has-children {
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 6px;
            border: 1px solid rgba(52, 152, 219, 0.2);
            background: rgba(52, 152, 219, 0.05);
            font-weight: 600;
            padding-right: 35px;
        }
        
        .nav-link.has-children.dropdownable:after {
            content: '\25BC';
            font-size: 0.8rem;
            position: absolute;
            right: 15px;
            color: #3498db;
            transition: transform 0.2s;
        }
        
        .nav-link.has-children.open.dropdownable:after {
            transform: rotate(180deg);
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Header Styles */
        .header {
            background: white;
            padding: 20px 30px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e2e8f0;
        }
        
        .page-title {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 700;
            padding: 5px 0;
        }
        
        /* Content Styles */
        .content {
            flex: 1;
            padding: 30px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        /* Footer Styles */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .copyright {
            color: #a0aec0;
            font-size: 0.95rem;
        }
        
        .footer-links {
            display: flex;
            gap: 20px;
        }
        
        .footer-link {
            color: #cbd5e0;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s;
            padding: 4px 8px;
            border-radius: 4px;
        }
        
        .footer-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 240px;
            }
            
            .main-content {
                margin-left: 240px;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-btn {
                display: block;
                background: none;
                border: none;
                font-size: 1.5rem;
                cursor: pointer;
                color: #2c3e50;
                padding: 5px 10px;
                border: 1px solid #e2e8f0;
                border-radius: 6px;
            }
            
            .header {
                padding: 15px 20px;
            }
            
            .content {
                padding: 20px;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 15px;
            }
        }
        
        /* Flash Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            border: 1px solid transparent;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-color: #a7f3d0;
        }
        
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-color: #fecaca;
        }
        
        /* Card Styles */
        .card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-title">Laravel Admin</div>
        </div>
        
        <div class="nav-section">
            <div class="nav-title">Navigation</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                        Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <div class="nav-link has-children dropdownable {{ request()->routeIs('categories.*') ? 'open' : '' }}" 
                         id="categoriesMenu">
                        Catégories
                    </div>
                    <ul class="sub-nav {{ request()->routeIs('categories.*') ? 'active' : '' }}" 
                        id="categoriesSubMenu">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" 
                               class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                                Liste des catégories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}" 
                               class="nav-link {{ request()->routeIs('categories.create') ? 'active' : '' }}">
                                Créer une catégorie
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                        À propos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">
                        Contact
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="nav-section">
            <div class="nav-title">Autres</div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ url('/hello') }}" class="nav-link {{ request()->is('hello') ? 'active' : '' }}">
                        Hello
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/user/admin') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                        Utilisateurs
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <button class="mobile-menu-btn" onclick="toggleSidebar()">☰</button>
            <h1 class="page-title">@yield('page-title', 'Tableau de bord')</h1>
        </header>
        
        <!-- Main Content Area -->
        <main class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </main>
        
        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="copyright">
                    © {{ date('Y') }} Laravel Marketplace. Tous droits réservés. @lapatia
                </div>
                <div class="footer-links">
                    <a href="#" class="footer-link">Mentions légales</a>
                    <a href="#" class="footer-link">Politique de confidentialité</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
            </div>
        </footer>
    </div>
    
    <script>
        // Sidebar mobile toggle
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }

        // Menu déroulant Catégories
        const categoriesMenu = document.getElementById('categoriesMenu');
        const categoriesSubMenu = document.getElementById('categoriesSubMenu');
        
        if (categoriesMenu && categoriesSubMenu) {
            // Garder ouvert si on est sur une page catégorie
            const isCategoryPage = window.location.pathname.includes('/categories');
            if (isCategoryPage) {
                categoriesSubMenu.classList.add('active');
                categoriesMenu.classList.add('open');
            }
            
            // Toggle manuel
            categoriesMenu.addEventListener('click', function(e) {
                const isOpen = categoriesSubMenu.classList.contains('active');
                categoriesSubMenu.classList.toggle('active', !isOpen);
                categoriesMenu.classList.toggle('open', !isOpen);
                e.stopPropagation();
            });
            
            // Fermer en cliquant ailleurs
            document.addEventListener('click', function(e) {
                if (categoriesMenu && categoriesSubMenu && 
                    !categoriesMenu.contains(e.target) && 
                    !categoriesSubMenu.contains(e.target)) {
                    // Ne pas fermer si on est sur une page catégorie
                    if (!window.location.pathname.includes('/categories')) {
                        categoriesSubMenu.classList.remove('active');
                        categoriesMenu.classList.remove('open');
                    }
                }
            });
            
            // Garder ouvert si on clique sur un lien enfant
            categoriesSubMenu.addEventListener('click', function(e) {
                if (e.target.tagName === 'A') {
                    e.stopPropagation();
                    // Fermer sidebar sur mobile
                    if (window.innerWidth <= 768) {
                        document.querySelector('.sidebar').classList.remove('active');
                    }
                }
            });
        }
        
        // Fermer sidebar mobile quand on clique sur un lien
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    document.querySelector('.sidebar').classList.remove('active');
                }
            });
        });
        
        // Fermer dropdown en changeant de page (pour navigation normale)
        window.addEventListener('popstate', function() {
            if (categoriesMenu && categoriesSubMenu) {
                const isCategoryPage = window.location.pathname.includes('/categories');
                categoriesSubMenu.classList.toggle('active', isCategoryPage);
                categoriesMenu.classList.toggle('open', isCategoryPage);
            }
        });
    </script>
</body>
</html>