<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zengfy | One Account. Infinite Ecosystem.</title>
    <meta name="description" content="Zengfy is Bangladesh's first NID-verified digital ecosystem. Manage your school, business POS, and legal practice with one secure unified account.">
    <meta name="keywords" content="Zengfy, Ecosystem, School ERP, POS Bangladesh, Legal Management, NID Verification, Unified SaaS">
    <meta name="author" content="Zengfy Inc.">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Zengfy | One Account. Infinite Ecosystem.">
    <meta property="og:description" content="Manage your school, business POS, and legal practice with one secure NID-verified account.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Zengfy | One Account. Infinite Ecosystem.">
    <meta property="twitter:description" content="Manage your school, business POS, and legal practice with one secure NID-verified account.">
    <meta property="twitter:image" content="{{ asset('images/logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Structured Data (JSON-LD) for Google Rich Snippets -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Organization",
          "@id": "{{ url('/') }}/#organization",
          "name": "Zengfy Inc.",
          "url": "{{ url('/') }}",
          "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('images/logo.png') }}"
          },
          "description": "Bangladesh's First NID-Verified Sovereign Digital Ecosystem.",
          "sameAs": [
            "https://twitter.com/zengfy",
            "https://facebook.com/zengfy",
            "https://linkedin.com/company/zengfy"
          ]
        },
        {
          "@type": "WebSite",
          "@id": "{{ url('/') }}/#website",
          "url": "{{ url('/') }}",
          "name": "Zengfy",
          "publisher": {
            "@id": "{{ url('/') }}/#organization"
          }
        },
        {
          "@type": "SoftwareApplication",
          "@id": "{{ url('/') }}/#software",
          "name": "Zengfy Unified Ecosystem",
          "operatingSystem": "Web, Android",
          "applicationCategory": "BusinessApplication",
          "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "BDT"
          },
          "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "ratingCount": "1250",
            "bestRating": "5",
            "worstRating": "1"
          }
        },
        {
          "@type": "FAQPage",
          "@id": "{{ url('/') }}/#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What is Zengfy and how does Single Sign-On (SSO) work?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Zengfy is a unified digital operating system for Bangladesh. Once you create a single account, you can access School ERP, POS Retail, Legal Suite, and Social Network using our 9-Dot App Switcher without ever re-entering passwords."
              }
            },
            {
              "@type": "Question",
              "name": "How is NID Verification handled and is my data secure?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "NID verification ensures real, accountable identities across our ecosystem to prevent fraud and spam. All institutional and financial data is stored using enterprise-grade 256-bit SSL encryption."
              }
            },
            {
              "@type": "Question",
              "name": "How does pricing and local payment work in Bangladesh?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Zengfy accounts are free forever for personal use. Specialized business modules have dedicated pricing tiers with native support for bKash, Nagad, Rocket, and local debit/credit cards."
              }
            },
            {
              "@type": "Question",
              "name": "Can I migrate my existing school or shop data to Zengfy?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes! Our onboarding team provides automated CSV and Excel import tools so you can effortlessly import students, inventory items, and historical customer data into Zengfy."
              }
            }
          ]
        }
      ]
    }
    </script>

    <!-- SEO Multi-Lingual & Regional hreflang Tags -->
    <link rel="alternate" hreflang="bn" href="{{ url()->current() }}?lang=bn" />
    <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en" />
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0B0F17] text-white antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden">

    <!-- 1. Header Navigation -->
    <x-landing.navbar />

    <!-- Main Landmark Content Body -->
    <main id="main-content" role="main" class="pt-20">
        <!-- 2. Hero Section -->
        <x-landing.hero />

        <!-- 3. Security & Trust Strip -->
        <x-landing.trust-badges />

        <!-- 4. Ecosystem Bento Grid -->
        <x-landing.bento-grid :services="$services" />

        <!-- 5. Single Sign-On (SSO) Feature Showcase -->
        <x-landing.sso-feature />

        <!-- 5.5 Mobile Android APK & Multi-Device Access Showcase -->
        <x-landing.mobile-app-section />

        <!-- 6. Testimonials Section -->
        <x-landing.testimonials />

        <!-- 7. FAQ Accordion Section -->
        <x-landing.faq-section />

        <!-- 8. Pre-Footer CTA Banner -->
        <x-landing.cta />
    </main>

    <!-- 9. Modern Footer -->
    <x-landing.footer />

</body>
</html>
