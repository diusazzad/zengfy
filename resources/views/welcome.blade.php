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

    <!-- Google Tag Manager (GTM) / GA4 Placeholder -->
    @if(env('GTM_ID'))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ env("GTM_ID") }}');</script>
    @endif

    <!-- JSON-LD Structured Data for Google Knowledge Graph -->
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
          "sameAs": [
            "https://facebook.com/zengfy",
            "https://linkedin.com/company/zengfy"
          ]
        },
        {
          "@type": "SoftwareApplication",
          "@id": "{{ url('/') }}/#software",
          "name": "Zengfy Ecosystem",
          "operatingSystem": "Web",
          "applicationCategory": "BusinessApplication",
          "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "BDT"
          },
          "description": "Zengfy is Bangladesh's first NID-verified digital ecosystem for School ERP, POS, and Legal Suite."
        }
      ]
    }
    </script>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0B0F17] text-white antialiased selection:bg-blue-600 selection:text-white overflow-x-hidden">

    <!-- 1. Header Navigation -->
    <x-landing.navbar />

    <!-- Main Content Body -->
    <main class="pt-20">
        <!-- 2. Hero Section -->
        <x-landing.hero />

        <!-- 3. Security & Trust Strip -->
        <x-landing.trust-badges />

        <!-- 4. Ecosystem Bento Grid -->
        <x-landing.bento-grid :services="$services" />

        <!-- 5. Single Sign-On (SSO) Feature Showcase -->
        <x-landing.sso-feature />

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
