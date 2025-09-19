<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Pasien</title>
    <style>
        /* ===== RESET & BASE STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* ===== BACKGROUND PARTICLES ===== */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 20px;
            height: 20px;
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 30px;
            height: 30px;
            top: 60%;
            left: 80%;
            animation-delay: 1s;
        }

        .particle:nth-child(3) {
            width: 15px;
            height: 15px;
            top: 80%;
            left: 40%;
            animation-delay: 2s;
        }

        .particle:nth-child(4) {
            width: 25px;
            height: 25px;
            top: 30%;
            left: 70%;
            animation-delay: 3s;
        }

        .particle:nth-child(5) {
            width: 18px;
            height: 18px;
            top: 70%;
            left: 10%;
            animation-delay: 4s;
        }

        /* ===== HEADER STYLES ===== */
        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 10;
            position: relative;
        }

        .logo {
            display: flex;
            align-items: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .logo::before {
            content: "🏥";
            margin-right: 10px;
            font-size: 2rem;
            animation: pulse 2s infinite;
        }

        .header-buttons {
            display: flex;
            gap: 1rem;
        }

        /* ===== BUTTON STYLES ===== */
        .btn {
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-block;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-login {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-register {
            background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
            color: white;
            border: 2px solid transparent;
        }

        .btn-register:hover {
            background: linear-gradient(45deg, #ff5252, #ff7979);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }

        .btn-primary {
            padding: 1.2rem 3rem;
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #45a049, #4CAF50);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.6);
        }

        .btn-secondary {
            padding: 1.2rem 3rem;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem;
            position: relative;
            z-index: 5;
        }

        .welcome-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 4rem 3rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            animation: slideUp 1s ease-out;
            max-width: 600px;
            margin: 0 auto;
        }

        .main-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeInScale 1.2s ease-out 0.3s both;
            line-height: 1.2;
        }

        .subtitle {
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            animation: fadeInSlide 1.2s ease-out 0.6s both;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            animation: fadeInUp 1.2s ease-out 0.9s both;
            flex-wrap: wrap;
        }

        /* ===== FEATURES SECTION ===== */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
            animation: fadeIn 1.5s ease-out 1.2s both;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: white;
            margin-bottom: 0.5rem;
        }

        .feature-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: rgba(0, 0, 0, 0.2);
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 10;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1.1rem;
            }
            
            .welcome-container {
                padding: 2.5rem 2rem;
                margin: 1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-primary,
            .btn-secondary {
                width: 100%;
                max-width: 300px;
            }
            
            .header {
                padding: 1rem;
            }
            
            .header-buttons {
                gap: 0.5rem;
            }
            
            .btn {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .main-title {
                font-size: 2rem;
            }
            
            .features {
                grid-template-columns: 1fr;
                margin-top: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background Particles -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Header Navigation -->
    <header class="header">
        <a href="{{ url('/') }}" class="logo">Sistem Pasien</a>
        <div class="header-buttons">
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn btn-register">Register</a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="main-content">
        <div class="welcome-container">
            <h1 class="main-title">Sistem Manajemen Pasien</h1>
            <p class="subtitle">Aplikasi untuk mengelola data pasien secara cepat dan aman dengan teknologi terdepan</p>

            <!-- Call-to-Action Buttons -->
            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk Sekarang</a>
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar Gratis</a>
            </div>

            <!-- Feature Cards -->
            <div class="features">
                <div class="feature-card">
                    <span class="feature-icon">⚡</span>
                    <h3 class="feature-title">Cepat & Efisien</h3>
                    <p class="feature-desc">Kelola data pasien dengan response time yang super cepat</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">🔒</span>
                    <h3 class="feature-title">Aman & Terpercaya</h3>
                    <p class="feature-desc">Data pasien dilindungi dengan enkripsi tingkat enterprise</p>
                </div>
                <div class="feature-card">
                    <span class="feature-icon">📱</span>
                    <h3 class="feature-title">Responsif</h3>
                    <p class="feature-desc">Akses dari desktop, tablet, atau smartphone dengan mudah</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Sistem Pasien. All rights reserved.</p>
    </footer>

    <!-- JavaScript for Interactive Effects -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced hover effects for feature cards
            const featureCards = document.querySelectorAll('.feature-card');
            
            featureCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });

            // Ripple effect for all buttons
            const buttons = document.querySelectorAll('.btn');
            
            buttons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.5);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    
                    // Remove ripple after animation
                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.remove();
                        }
                    }, 600);
                });
            });

            // Smooth scroll for internal links (if any)
            const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
            
            smoothScrollLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add loading animation completion
            window.addEventListener('load', function() {
                document.body.classList.add('loaded');
            });
        });
    </script>
</body>
</html>