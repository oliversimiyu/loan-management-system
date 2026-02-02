<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
                min-height: 100vh;
            }
            
            .auth-card {
                background: white;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                padding: 2.5rem;
            }
            
            .company-logo {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
                border-radius: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 2rem;
                font-weight: 700;
                box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
                margin: 0 auto 1rem;
            }
            
            .company-name {
                font-size: 1.75rem;
                font-weight: 700;
                color: #1e3a8a;
                text-align: center;
                margin-bottom: 0.5rem;
            }
            
            .company-tagline {
                color: #6b7280;
                text-align: center;
                margin-bottom: 2rem;
                font-size: 0.95rem;
            }
            
            input[type="email"],
            input[type="password"],
            input[type="text"] {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 2px solid #e5e7eb;
                border-radius: 8px;
                font-size: 1rem;
                transition: all 0.3s;
            }
            
            input[type="email"]:focus,
            input[type="password"]:focus,
            input[type="text"]:focus {
                outline: none;
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
                color: white;
                padding: 0.75rem 2rem;
                border-radius: 8px;
                font-weight: 600;
                border: none;
                cursor: pointer;
                transition: all 0.3s;
                width: 100%;
                font-size: 1rem;
            }
            
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(30, 58, 138, 0.4);
            }
            
            label {
                display: block;
                color: #374151;
                font-weight: 600;
                margin-bottom: 0.5rem;
                font-size: 0.95rem;
            }
            
            .form-group {
                margin-bottom: 1.5rem;
            }
            
            .link-text {
                color: #3b82f6;
                text-decoration: none;
                font-size: 0.9rem;
                transition: color 0.3s;
            }
            
            .link-text:hover {
                color: #1e3a8a;
                text-decoration: underline;
            }
            
            .checkbox-label {
                display: flex;
                align-items: center;
                font-weight: normal;
                color: #6b7280;
            }
            
            input[type="checkbox"] {
                margin-right: 0.5rem;
                width: 1.25rem;
                height: 1.25rem;
                cursor: pointer;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="padding: 2rem;">
            <div style="margin-bottom: 2rem;">
                <div class="company-logo">DI</div>
                <h1 class="company-name">Demulla Investment Limited</h1>
                <p class="company-tagline">Empowering Financial Growth</p>
            </div>

            <div class="w-full sm:max-w-md auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
