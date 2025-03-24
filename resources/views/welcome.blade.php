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
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #4B5563;
            /* Gray */
            --secondary-color: #6B7280;
            /* Lighter Gray */
            --accent-color: #454545;
            /* Red for accents */
            --background-color: #F9FAFB;
            /* Light Background */
            --text-color: #1F2937;
            /* Dark Text */
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

        /* Sticky Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .navbar .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .navbar .nav-links a {
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar .nav-links a:hover {
            color: var(--accent-color);
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
            overflow: hidden;
            border-radius: 0.5rem;
        }

        .hero-section .image-container img {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hero-section .image-container img:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

        /* About FinWise Section */
        .about-finwise {
            background-color: var(--primary-color);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        .about-finwise h2 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
        }

        .about-finwise p {
            font-size: 1rem;
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        /* Cards for Vision, Mission, and Features */
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0.5rem;
            padding: 1.5rem;
            width: 100%;
            max-width: 350px;
            text-align: left;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .card p {
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* FAQ Section */
        .faq-section {
            padding: 4rem 2rem;
            background-color: white;
            text-align: left;
        }

        .faq-section h2 {
            font-size: 1.75rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .faq-item {
            margin-bottom: 1rem;
        }

        .faq-question {
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            transition: background-color 0.3s ease;
        }

        .faq-question:hover {
            background-color: var(--accent-color);
        }

        .faq-answer {
            max-height: 0;
            /* Jawaban disembunyikan dengan max-height */
            overflow: hidden;
            padding: 0 0.75rem;
            /* Padding horizontal saja */
            font-size: 0.9rem;
            color: var(--secondary-color);
            background-color: var(--background-color);
            border: 1px solid var(--secondary-color);
            border-radius: 0.5rem;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .faq-answer.active {
            max-height: 200px;
            /* Sesuaikan dengan tinggi maksimal jawaban */
            padding: 0.75rem;
            /* Padding normal saat aktif */
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 4rem 2rem;
            text-align: center;
        }

        footer .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        footer .footer-column {
            flex: 1;
            min-width: 200px;
        }

        footer .footer-column h3 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        footer .footer-column ul {
            list-style: none;
            padding: 0;
        }

        footer .footer-column ul li {
            margin-bottom: 0.5rem;
        }

        footer .footer-column a {
            color: white;
            transition: color 0.3s ease;
        }

        footer .footer-column a:hover {
            color: var(--accent-color);
        }

        footer .social-icons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
        }

        footer .social-icons a {
            color: white;
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        footer .social-icons a:hover {
            transform: scale(1.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                flex-direction: column;
            }

            .hero-section .image-container {
                order: 1;
            }

            .hero-section .content-container {
                order: 2;
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
    <!-- Sticky Navbar -->
    <nav class="navbar">
        <div class="logo">FinWise</div>
        <div class="nav-links">
            <a href="#">Beranda</a>
            <a href="#about-finwise">Latar Belakang</a>
            <a href="#faq-section">FAQ</a>
        </div>
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
            <img src="https://www.alphajwc.com/wp-content/uploads/2022/05/business-man-accounting-calculating-cost-economic-budget-investment-saving.jpg"
                alt="Financial Illustration">
        </div>
        <div class="content-container">
            <h1>Kelola Keuangan Anda dengan Mudah</h1>
            <p>Temukan cara baru untuk mengelola anggaran, melacak pengeluaran, dan merencanakan masa depan keuangan
                Anda.</p>
            <a href="{{ route('register') }}" class="btn-hero">Mulai Sekarang</a>
        </div>
    </section>

    <!-- About FinWise Section -->
    <section id="about-finwise" class="about-finwise">
        <h2>Tentang FinWise</h2>
        <p>
            FinWise adalah platform manajemen keuangan modern yang dirancang untuk membantu individu dan bisnis
            mengelola anggaran, melacak pengeluaran, dan merencanakan masa depan finansial mereka dengan mudah dan
            efisien.
        </p>
        <div class="cards-container">
            <div class="card">
                <h3>Visi Kami</h3>
                <p>
                    Kami percaya bahwa setiap individu berhak memiliki akses ke alat yang memungkinkan mereka membuat
                    keputusan keuangan yang cerdas. Visi kami adalah menciptakan dunia di mana semua orang dapat
                    merencanakan masa depan keuangan mereka dengan percaya diri.
                </p>
            </div>
            <div class="card">
                <h3>Misi Kami</h3>
                <p>
                    Misi FinWise adalah menyediakan platform yang intuitif, aman, dan andal bagi pengguna untuk
                    mengelola keuangan mereka secara efektif. Kami berkomitmen untuk memberikan edukasi finansial dan
                    dukungan pelanggan yang responsif.
                </p>
            </div>
            <div class="card">
                <h3>Apa yang Membuat FinWise Berbeda?</h3>
                <ul style="list-style-type: disc; padding-left: 1rem;">
                    <li>Antarmuka Pengguna yang Ramah</li>
                    <li>Fitur Komprehensif</li>
                    <li>Keamanan Terjamin</li>
                    <li>Integrasi dengan Bank dan Aplikasi Lainnya</li>
                    <li>Edukasi Finansial</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq-section" class="faq-section">
        <h2>Pertanyaan Umum (FAQ)</h2>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(this)">
                Apa itu FinWise?
            </div>
            <div class="faq-answer">
                FinWise adalah platform manajemen keuangan yang membantu Anda mengelola anggaran dan melacak
                pengeluaran.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(this)">
                Bagaimana cara mendaftar?
            </div>
            <div class="faq-answer">
                Anda dapat mendaftar dengan mengklik tombol "Register" di halaman utama.
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question" onclick="toggleAnswer(this)">
                Apakah ada biaya berlangganan?
            </div>
            <div class="faq-answer">
                Tidak, FinWise sepenuhnya gratis untuk digunakan.
            </div>
        </div>
    </section>

    <!-- JavaScript for FAQ Accordion -->
    <script>
        function toggleAnswer(element) {
            const answer = element.nextElementSibling;
            answer.classList.toggle('active');
        }
    </script>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>FinWise</h3>
                <p>Platform manajemen keuangan terbaik untuk mengelola anggaran dan melacak pengeluaran.</p>
            </div>
            <div class="footer-column">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#about-finwise">Latar Belakang</a></li>
                    <li><a href="#faq-section">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Kontak</h3>
                <ul>
                    <li>Email: support@finwise.com</li>
                    <li>Telepon: +62 123 456 789</li>
                </ul>
            </div>
        </div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2025 Financial Management. by Muhamad Ali.</p>
    </footer>

    <!-- JavaScript for FAQ Accordion -->
    <script>
        function toggleAnswer(element) {
            const answer = element.nextElementSibling;
            answer.classList.toggle('active');
        }
    </script>
</body>

</html>