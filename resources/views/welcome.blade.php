<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Management</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #4B5563; /* Gray */
            --secondary-color: #6B7280; /* Lighter Gray */
            --accent-color: #454545; /* Red for accents */
            --background-color: #F9FAFB; /* Light Background */
            --text-color: #1F2937; /* Dark Text */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
        }

        a:hover {
            color: var(--accent-color);
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .navbar .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .navbar .btn {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .navbar .btn-primary {
            background-color: var(--accent-color);
            color: white;
            border: 2px solid var(--accent-color);
        }

        .navbar .btn-secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }

        .navbar .btn-primary:hover {
            background-color: white;
            color: var(--accent-color);
        }

        .navbar .btn-secondary:hover {
            background-color: white;
            color: var(--accent-color);
        }

        /* Main Content */
        main {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }

        /* Hero Section */
        .hero-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hero-section .image-container {
            flex: 1;
        }

        .hero-section .image-container img {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
        }

        .hero-section .content-container {
            flex: 1;
            text-align: left;
        }

        .hero-section .content-container h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .hero-section .content-container p {
            font-size: 1.25rem;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .hero-section .content-container .btn-hero {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .hero-section .content-container .btn-hero:hover {
            background-color: var(--primary-color);
        }

        /* Cards Section */
        .cards-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background-color: white;
            border: 1px solid var(--secondary-color);
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            width: 100%;
            max-width: 300px;
            padding: 1.5rem;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .card p {
            font-size: 1rem;
            color: var(--secondary-color);
        }

        /* Footer */
        footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .navbar .auth-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }

            .hero-section {
                flex-direction: column;
            }

            .hero-section .image-container {
                order: 2;
            }

            .hero-section .content-container {
                order: 1;
                text-align: center;
            }

            .hero-section .content-container h1 {
                font-size: 2rem;
            }

            .hero-section .content-container p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">FinWise</div>

        <div class="auth-buttons">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary">Log In</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="image-container">
            <img src="https://www.alphajwc.com/wp-content/uploads/2022/05/business-man-accounting-calculating-cost-economic-budget-investment-saving.jpg" alt="Financial Illustration">
        </div>
        <div class="content-container">
            <h1>Kelola Keuangan Anda dengan Mudah</h1>
            <p>Temukan cara baru untuk mengelola anggaran, melacak pengeluaran, dan merencanakan masa depan keuangan Anda.</p>
            <a href="{{ route('register') }}" class="btn-hero">Mulai Sekarang</a>
        </div>
    </section>

    <!-- Cards Section -->
    <main class="cards-section">
        <!-- Card 1: Documentation -->
        <div class="card">
            <h2>Documentation</h2>
            <p>Explore our comprehensive documentation to learn how to manage budgets and track expenses.</p>
        </div>

        <!-- Card 2: Tutorials -->
        <div class="card">
            <h2>Tutorials</h2>
            <p>Watch video tutorials on budgeting, investment strategies, and financial planning to enhance your skills.</p>
        </div>

        <!-- Card 3: Financial News -->
        <div class="card">
            <h2>Financial News</h2>
            <p>Stay updated with the latest news and trends in the financial world.</p>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        &copy; 2025 Financial Management. by Muhamad Ali.
    </footer>
</body>
</html>