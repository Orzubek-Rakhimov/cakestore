<?php
// index.php - John's Portfolio

$name = "John";
$location = "Los Angeles";
$email = "john@example.com";
$title = "PHP / Laravel Developer";
$bio = "Passionate developer crafting elegant solutions with clean code. Specialized in building scalable web applications with Laravel and modern PHP practices.";

$skills = [
    ['name' => 'PHP', 'level' => 95, 'icon' => '🐘'],
    ['name' => 'Laravel', 'level' => 90, 'icon' => '🔺'],
    ['name' => 'MySQL', 'level' => 85, 'icon' => '🗄️'],
    ['name' => 'JavaScript', 'level' => 80, 'icon' => '⚡'],
    ['name' => 'Vue.js', 'level' => 75, 'icon' => '💚'],
    ['name' => 'API Development', 'level' => 88, 'icon' => '🔗'],
];

$projects = [
    [
        'title' => 'E-Commerce Platform',
        'description' => 'Full-featured online store with payment integration, inventory management, and admin dashboard.',
        'tags' => ['Laravel', 'Vue.js', 'Stripe'],
        'color' => '#6366f1'
    ],
    [
        'title' => 'SaaS Dashboard',
        'description' => 'Multi-tenant application with real-time analytics, user management, and subscription billing.',
        'tags' => ['Laravel', 'Livewire', 'Tailwind'],
        'color' => '#ec4899'
    ],
    [
        'title' => 'REST API Service',
        'description' => 'High-performance API serving millions of requests with comprehensive documentation.',
        'tags' => ['PHP', 'Redis', 'Docker'],
        'color' => '#14b8a6'
    ],
    [
        'title' => 'CMS Platform',
        'description' => 'Custom content management system with drag-and-drop builder and SEO optimization.',
        'tags' => ['Laravel', 'MySQL', 'Alpine.js'],
        'color' => '#f59e0b'
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name ?> | <?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #ec4899;
            --dark: #0f0f1a;
            --darker: #070710;
            --light: #f8fafc;
            --gray: #94a3b8;
            --card-bg: rgba(255, 255, 255, 0.03);
            --border: rgba(255, 255, 255, 0.08);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--darker);
            color: var(--light);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Cursor */
        .cursor {
            width: 20px;
            height: 20px;
            border: 2px solid var(--primary);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.1s;
            mix-blend-mode: difference;
        }

        .cursor-dot {
            width: 6px;
            height: 6px;
            background: var(--secondary);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
        }

        /* Noise Overlay */
        .noise {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
        }

        /* Gradient Orbs */
        .gradient-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            pointer-events: none;
            z-index: -1;
        }

        .orb-1 {
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            top: -200px;
            right: -200px;
        }

        .orb-2 {
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #14b8a6, var(--primary));
            bottom: -150px;
            left: -150px;
        }

        .orb-3 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, var(--secondary), #f59e0b);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.2;
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            backdrop-filter: blur(20px);
            background: rgba(7, 7, 16, 0.8);
            border-bottom: 1px solid var(--border);
        }

        .logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 3rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--gray);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: width 0.3s;
        }

        .nav-links a:hover {
            color: var(--light);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 0 10%;
            position: relative;
        }

        .hero-content {
            max-width: 900px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 50px;
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 2rem;
        }

        .hero-badge .dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
        }

        .hero h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .hero h1 .line {
            display: block;
            overflow: hidden;
        }

        .hero h1 .gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary), #14b8a6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.25rem;
            color: var(--gray);
            max-width: 600px;
            margin-bottom: 3rem;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: var(--card-bg);
            color: var(--light);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
        }

        .hero-visual {
            position: absolute;
            right: 5%;
            top: 50%;
            transform: translateY(-50%);
            width: 400px;
            height: 400px;
        }

        .hero-shape {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid var(--border);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: morph 8s ease-in-out infinite;
        }

        .hero-shape:nth-child(2) {
            animation-delay: -2s;
            opacity: 0.5;
        }

        .hero-shape:nth-child(3) {
            animation-delay: -4s;
            opacity: 0.3;
        }

        @keyframes morph {
            0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
            75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 3rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray);
            font-size: 0.85rem;
        }

        .scroll-indicator .mouse {
            width: 26px;
            height: 40px;
            border: 2px solid var(--gray);
            border-radius: 20px;
            position: relative;
        }

        .scroll-indicator .wheel {
            width: 4px;
            height: 8px;
            background: var(--primary);
            border-radius: 2px;
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            animation: scroll 2s infinite;
        }

        @keyframes scroll {
            0% { opacity: 1; transform: translateX(-50%) translateY(0); }
            100% { opacity: 0; transform: translateX(-50%) translateY(15px); }
        }

        /* Section Styles */
        section {
            padding: 8rem 10%;
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: 5rem;
        }

        .section-tag {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 50px;
            font-size: 0.85rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* About Section */
        .about {
            background: linear-gradient(180deg, var(--darker), var(--dark));
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .about-image {
            position: relative;
        }

        .about-image-wrapper {
            position: relative;
            border-radius: 30px;
            overflow: hidden;
            aspect-ratio: 4/5;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .about-image-wrapper::before {
            content: '';
            position: absolute;
            inset: 3px;
            background: var(--dark);
            border-radius: 28px;
            z-index: 1;
        }

        .about-image-placeholder {
            position: absolute;
            inset: 3px;
            border-radius: 28px;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(236, 72, 153, 0.1));
        }

        .floating-card {
            position: absolute;
            background: rgba(15, 15, 26, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.5rem;
            z-index: 3;
        }

        .floating-card.experience {
            bottom: -30px;
            right: -30px;
            text-align: center;
        }

        .floating-card .number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating-card .label {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .floating-card.projects-count {
            top: 20px;
            left: -40px;
        }

        .about-content h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .about-content p {
            color: var(--gray);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .stat {
            text-align: center;
            padding: 1.5rem;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
        }

        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        /* Skills Section */
        .skills {
            background: var(--dark);
        }

        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .skill-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .skill-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s;
        }

        .skill-card:hover {
            transform: translateY(-10px);
            border-color: var(--primary);
            box-shadow: 0 20px 60px rgba(99, 102, 241, 0.15);
        }

        .skill-card:hover::before {
            transform: scaleX(1);
        }

        .skill-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            display: block;
        }

        .skill-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .skill-bar {
            height: 6px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
            overflow: hidden;
        }

        .skill-progress {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 3px;
            width: 0;
            transition: width 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .skill-level {
            display: flex;
            justify-content: space-between;
            margin-top: 0.75rem;
            color: var(--gray);
            font-size: 0.85rem;
        }

        /* Projects Section */
        .projects {
            background: linear-gradient(180deg, var(--dark), var(--darker));
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2.5rem;
        }

        .project-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .project-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.3);
        }

        .project-image {
            height: 250px;
            position: relative;
            overflow: hidden;
        }

        .project-image-bg {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            opacity: 0.3;
            transition: all 0.4s;
        }

        .project-card:hover .project-image-bg {
            transform: scale(1.1);
            opacity: 0.5;
        }

        .project-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.8));
        }

        .project-content {
            padding: 2rem;
        }

        .project-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .project-description {
            color: var(--gray);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .project-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .project-tag {
            padding: 0.4rem 1rem;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 50px;
            font-size: 0.8rem;
            color: var(--primary);
        }

        .project-link {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s;
        }

        .project-card:hover .project-link {
            opacity: 1;
            transform: translateY(0);
        }

        /* Contact Section */
        .contact {
            background: var(--darker);
            text-align: center;
        }

        .contact-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .contact-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .contact-title .gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .contact-text {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-email {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            color: var(--light);
            text-decoration: none;
            padding: 1.5rem 3rem;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 100px;
            margin: 3rem 0;
            transition: all 0.3s;
        }

        .contact-email:hover {
            border-color: var(--primary);
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.2);
            transform: translateY(-3px);
        }

        .socials {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .social-link {
            width: 60px;
            height: 60px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            text-decoration: none;
            font-size: 1.5rem;
            transition: all 0.3s;
        }

        .social-link:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: translateY(-5px);
        }

        /* Footer */
        footer {
            padding: 3rem 10%;
            text-align: center;
            border-top: 1px solid var(--border);
            color: var(--gray);
        }

        footer p {
            font-size: 0.9rem;
        }

        /* Marquee */
        .marquee-section {
            padding: 2rem 0;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            overflow: hidden;
        }

        .marquee {
            display: flex;
            animation: marquee 20s linear infinite;
        }

        .marquee-content {
            display: flex;
            gap: 4rem;
            padding: 0 2rem;
            white-space: nowrap;
        }

        .marquee-content span {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
            opacity: 0.9;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Animation Classes */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-visual {
                display: none;
            }

            .about-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .about-image {
                max-width: 400px;
                margin: 0 auto;
            }

            .projects-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 768px) {
            section {
                padding: 5rem 5%;
            }

            .hero {
                padding: 0 5%;
            }

            .about-stats {
                grid-template-columns: 1fr;
            }

            .skills-grid {
                grid-template-columns: 1fr;
            }

            .floating-card {
                display: none;
            }

            .contact-email {
                font-size: 1rem;
                padding: 1rem 2rem;
            }
        }

        /* Page Loader */
        .loader {
            position: fixed;
            inset: 0;
            background: var(--darker);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader-content {
            text-align: center;
        }

        .loader-logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .loader-bar {
            width: 200px;
            height: 3px;
            background: var(--border);
            border-radius: 3px;
            margin-top: 2rem;
            overflow: hidden;
        }

        .loader-progress {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            width: 0;
        }

        .loader.hidden {
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s;
        }
    </style>
</head>
<body>
    <!-- Loader -->
    <div class="loader" id="loader">
        <div class="loader-content">
            <div class="loader-logo"><?= $name[0] ?>.</div>
            <div class="loader-bar">
                <div class="loader-progress" id="loader-progress"></div>
            </div>
        </div>
    </div>

    <!-- Cursor -->
    <div class="cursor"></div>
    <div class="cursor-dot"></div>

    <!-- Noise -->
    <div class="noise"></div>

    <!-- Gradient Orbs -->
    <div class="gradient-orb orb-1"></div>
    <div class="gradient-orb orb-2"></div>
    <div class="gradient-orb orb-3"></div>

    <!-- Navigation -->
    <nav>
        <a href="#" class="logo"><?= $name[0] ?>.</a>
        <ul class="nav-links">
            <li><a href="#about">About</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="dot"></span>
                Available for freelance work
            </div>
            <h1>
                <span class="line"><span class="word">Hi, I'm</span></span>
                <span class="line"><span class="word gradient"><?= $name ?>.</span></span>
                <span class="line"><span class="word"><?= $title ?></span></span>
            </h1>
            <p class="hero-description"><?= $bio ?></p>
            <div class="hero-buttons">
                <a href="#contact" class="btn btn-primary">
                    Get in Touch
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="#projects" class="btn btn-secondary">View Projects</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-shape"></div>
            <div class="hero-shape"></div>
            <div class="hero-shape"></div>
        </div>
        <div class="scroll-indicator">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
            <span>Scroll Down</span>
        </div>
    </section>

    <!-- Marquee -->
    <div class="marquee-section">
        <div class="marquee">
            <div class="marquee-content">
                <span>✦ Laravel Expert</span>
                <span>✦ Clean Code</span>
                <span>✦ API Development</span>
                <span>✦ Database Design</span>
                <span>✦ Performance Optimization</span>
                <span>✦ Laravel Expert</span>
                <span>✦ Clean Code</span>
                <span>✦ API Development</span>
                <span>✦ Database Design</span>
                <span>✦ Performance Optimization</span>
            </div>
            <div class="marquee-content">
                <span>✦ Laravel Expert</span>
                <span>✦ Clean Code</span>
                <span>✦ API Development</span>
                <span>✦ Database Design</span>
                <span>✦ Performance Optimization</span>
                <span>✦ Laravel Expert</span>
                <span>✦ Clean Code</span>
                <span>✦ API Development</span>
                <span>✦ Database Design</span>
                <span>✦ Performance Optimization</span>
            </div>
        </div>
    </div>

    <!-- About -->
    <section class="about" id="about">
        <div class="about-grid">
            <div class="about-image animate-on-scroll">
                <div class="about-image-wrapper">
                    <div class="about-image-placeholder">👨💻</div>
                </div>
                <div class="floating-card experience">
                    <div class="number">5+</div>
                    <div class="label">Years Experience</div>
                </div>
                <div class="floating-card projects-count">
                    <div class="number">50+</div>
                    <div class="label">Projects Done</div>
                </div>
            </div>
            <div class="about-content animate-on-scroll">
                <span class="section-tag">About Me</span>
                <h3>Crafting Digital Experiences with Laravel</h3>
                <p>Based in <?= $location ?>, I specialize in building robust, scalable web applications using Laravel and modern PHP. With a passion for clean architecture and efficient code, I transform complex problems into elegant solutions.</p>
                <p>I believe in writing code that not only works but is maintainable, testable, and a joy to work with. Whether it's building APIs, crafting admin dashboards, or architecting entire platforms, I bring dedication and expertise to every project.</p>
                <div class="about-stats">
                    <div class="stat">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">30+</div>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                    <div class="stat">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills -->
    <section class="skills" id="skills">
        <div class="section-header">
            <span class="section-tag">Skills</span>
            <h2 class="section-title">My Expertise</h2>
            <p class="section-subtitle">Technologies and tools I use to bring ideas to life</p>
        </div>
        <div class="skills-grid">
            <?php foreach ($skills as $index => $skill): ?>
            <div class="skill-card animate-on-scroll" style="transition-delay: <?= $index * 0.1 ?>s;">
                <span class="skill-icon"><?= $skill['icon'] ?></span>
                <h4 class="skill-name"><?= $skill['name'] ?></h4>
                <div class="skill-bar">
                    <div class="skill-progress" data-progress="<?= $skill['level'] ?>"></div>
                </div>
                <div class="skill-level">
                    <span>Proficiency</span>
                    <span><?= $skill['level'] ?>%</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Projects -->
    <section class="projects" id="projects">
        <div class="section-header">
            <span class="section-tag">Portfolio</span>
            <h2 class="section-title">Featured Projects</h2>
            <p class="section-subtitle">A selection of my recent work and side projects</p>
        </div>
        <div class="projects-grid">
            <?php foreach ($projects as $index => $project): ?>
            <div class="project-card animate-on-scroll" style="transition-delay: <?= $index * 0.15 ?>s;">
                <div class="project-image" style="background: <?= $project['color'] ?>20;">
                    <div class="project-image-bg">💻</div>
                    <div class="project-overlay"></div>
                </div>
                <div class="project-content">
                    <h3 class="project-title"><?= $project['title'] ?></h3>
                    <p class="project-description"><?= $project['description'] ?></p>
                    <div class="project-tags">
                        <?php foreach ($project['tags'] as $tag): ?>
                        <span class="project-tag"><?= $tag ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <a href="#" class="project-link">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                    </svg>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Contact -->
    <section class="contact" id="contact">
        <div class="contact-content">
            <span class="section-tag animate-on-scroll">Get in Touch</span>
            <h2 class="contact-title animate-on-scroll">Let's Work <span class="gradient">Together</span></h2>
            <p class="contact-text animate-on-scroll">Have a project in mind? Let's discuss how we can bring your ideas to life.</p>
            <a href="mailto:<?= $email ?>" class="contact-email animate-on-scroll">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="M22 7l-10 6L2 7"/>
                </svg>
                <?= $email ?>
            </a>
            <div class="socials animate-on-scroll">
                <a href="#" class="social-link" aria-label="GitHub">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                    </svg>
                </a>
                <a href="#" class="social-link" aria-label="LinkedIn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>
                <a href="#" class="social-link" aria-label="Twitter">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© <?= date('Y') ?> <?= $name ?>. Crafted with ❤️ and Laravel</p>
    </footer>

    <script>
        // Wait for DOM to load
        document.addEventListener('DOMContentLoaded', function() {
            
            // Loader Animation
            const loader = document.getElementById('loader');
            const loaderProgress = document.getElementById('loader-progress');
            
            gsap.to(loaderProgress, {
                width: '100%',
                duration: 1.2,
                ease: 'power2.inOut',
                onComplete: function() {
                    gsap.to(loader, {
                        opacity: 0,
                        duration: 0.5,
                        onComplete: function() {
                            loader.classList.add('hidden');
                            initAnimations();
                        }
                    });
                }
            });

            function initAnimations() {
                // Custom Cursor
                const cursor = document.querySelector('.cursor');
                const cursorDot = document.querySelector('.cursor-dot');

                if (cursor && cursorDot) {
                    document.addEventListener('mousemove', (e) => {
                        gsap.to(cursor, {
                            x: e.clientX - 10,
                            y: e.clientY - 10,
                            duration: 0.3
                        });
                        gsap.to(cursorDot, {
                            x: e.clientX - 3,
                            y: e.clientY - 3,
                            duration: 0.1
                        });
                    });

                    document.querySelectorAll('a, button, .project-card, .skill-card').forEach(el => {
                        el.addEventListener('mouseenter', () => {
                            gsap.to(cursor, { scale: 2, opacity: 0.5 });
                        });
                        el.addEventListener('mouseleave', () => {
                            gsap.to(cursor, { scale: 1, opacity: 1 });
                        });
                    });
                }

                // Parallax Orbs
                document.addEventListener('mousemove', (e) => {
                    const x = (e.clientX - window.innerWidth / 2) / 50;
                    const y = (e.clientY - window.innerHeight / 2) / 50;
                    
                    gsap.to('.orb-1', { x: x * 2, y: y * 2, duration: 1 });
                    gsap.to('.orb-2', { x: -x * 1.5, y: -y * 1.5, duration: 1 });
                    gsap.to('.orb-3', { x: x, y: y, duration: 1 });
                });

                // Hero Animation
                gsap.from('.hero-content > *', {
                    y: 50,
                    opacity: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: 'power3.out'
                });

                // Intersection Observer for scroll animations
                const observerOptions = {
                    root: null,
                    rootMargin: '0px',
                    threshold: 0.1
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            
                            // Animate skill progress bars
                            const progressBar = entry.target.querySelector('.skill-progress');
                            if (progressBar) {
                                const progress = progressBar.dataset.progress;
                                setTimeout(() => {
                                    progressBar.style.width = progress + '%';
                                }, 300);
                            }
                        }
                    });
                }, observerOptions);

                // Observe all animate-on-scroll elements
                document.querySelectorAll('.animate-on-scroll').forEach(el => {
                    observer.observe(el);
                });

                // Magnetic Effect for Buttons
                document.querySelectorAll('.btn, .social-link').forEach(btn => {
                    btn.addEventListener('mousemove', (e) => {
                        const rect = btn.getBoundingClientRect();
                        const x = e.clientX - rect.left - rect.width / 2;
                        const y = e.clientY - rect.top - rect.height / 2;
                        
                        gsap.to(btn, {
                            x: x * 0.3,
                            y: y * 0.3,
                            duration: 0.3
                        });
                    });
                    
                    btn.addEventListener('mouseleave', () => {
                        gsap.to(btn, {
                            x: 0,
                            y: 0,
                            duration: 0.5,
                            ease: 'elastic.out(1, 0.5)'
                        });
                    });
                });

                // Smooth Scroll for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        const targetId = this.getAttribute('href');
                        if (targetId === '#') return;
                        
                        const target = document.querySelector(targetId);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
