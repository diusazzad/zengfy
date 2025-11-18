<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <title>আমাদের টীম | Zengfy.top</title>
    <style>
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
            padding-bottom: 70px;
        }

        .fixed-navbar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: none;
        }

        @media (max-width: 768px) {
            .fixed-navbar {
                display: flex;
            }

            body {
                padding-bottom: 70px;
            }
        }

        .nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 10px 0;
            text-decoration: none;
            color: #4B5563;
            transition: all 0.3s ease;
        }

        .nav-item.active {
            color: #2563EB;
        }

        .nav-item:hover {
            color: #2563EB;
        }

        .nav-icon {
            font-size: 1.2rem;
            margin-bottom: 4px;
        }

        .nav-text {
            font-size: 0.7rem;
        }

        .team-section {
            font-family: 'Noto Sans Bengali', sans-serif;
            background-color: #f7f7f7;
        }

        .team-card {
            background-color: #fff;
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .team-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .team-card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1.5rem;
            position: relative;
        }

        .profile-img-container {
            width: 100px;
            height: 100px;
            margin: 0 auto;
            position: relative;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-glow {
            width: 110%;
            height: 110%;
            top: -5%;
            left: -5%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.4), transparent);
            filter: blur(10px);
            z-index: 0;
        }

        .profile-name {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-top: 1rem;
        }

        .profile-title {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            text-align: center;
        }

        .social-links {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .team-card-body {
            padding: 1.5rem;
        }

        .bio-tab-container {
            border: none;
        }

        .nav-tabs {
            display: flex;
            border-bottom: 2px solid #e5e7eb;
            margin-bottom: 1rem;
        }

        .nav-link {
            padding: 0.5rem 1rem;
            color: #6b7280;
            border: none;
            background: none;
            font-weight: 500;
            cursor: pointer;
        }

        .nav-link.active {
            color: #2563EB;
            border-bottom: 3px solid #2563EB;
        }

        .tab-content {
            padding: 0;
        }

        .bio-text {
            color: #4b5563;
            font-size: 1rem;
            line-height: 1.7;
            text-align: justify;
        }

        .language-switcher {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .language-btn {
            padding: 0.5rem 1rem;
            background: #f3f4f6;
            border: none;
            border-radius: 0.25rem;
            margin: 0 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .language-btn.active {
            background: #2563EB;
            color: white;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
            font-weight: 700;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 60%;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            bottom: -10px;
            left: 20%;
        }

        /* Dark Mode Styles */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1f2937;
                color: #fff;
            }

            .team-section {
                background-color: #111827;
            }

            .team-card {
                background-color: #374151;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            }

            .nav-tabs {
                border-bottom: 2px solid #4b5563;
            }

            .nav-link {
                color: #d1d5db;
            }

            .nav-link.active {
                color: #3b82f6;
                border-bottom: 3px solid #3b82f6;
            }

            .bio-text {
                color: #e5e7eb;
            }

            .language-btn {
                background: #4b5563;
                color: #e5e7eb;
            }

            .language-btn.active {
                background: #3b82f6;
                color: white;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .team-card {
            animation: fadeIn 0.6s ease-out;
        }

        .team-card:nth-child(2) {
            animation-delay: 0.2s;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-800">
    <!-- Desktop Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40 hidden md:block">
        <div class="max-w-6xl mx-auto px-4 flex items-center justify-between h-16">
            <a href="https://zengfy.top" class="text-2xl font-extrabold text-blue-600">Zengfy.top</a>
            <nav class="flex space-x-6">
                <a href="{{ route('welcome') }}" class="hover:text-blue-600">হোম</a>
                <a href="{{ route('team') }}" class="text-blue-600 font-semibold">টীম</a>
                <a href="{{ route('team') }}" class="hover:text-blue-600">যোগাযোগ</a>
                <a href="{{ route('signup') }}"
                    class="bg-yellow-400 text-gray-900 px-4 py-2 rounded font-semibold hover:bg-yellow-300">সাইন আপ</a>
            </nav>
        </div>
    </header>

    <!-- Team Section -->
    <section class="team-section py-12 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl text-center mb-4 font-bold text-gray-800 dark:text-white section-title">আমাদের টীম</h2>
            <p class="text-center text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-10">Zengfy.top এর পিছনে থাকা
                প্রতিভাবান ব্যক্তিদের সাথে পরিচিত হোন, যারা আমাদের প্ল্যাটফর্মকে অনন্য করে তুলেছে</p>

            <div class="language-switcher">
                <button class="language-btn active" id="btn-bn">বাংলা</button>
                <button class="language-btn" id="btn-en">English</button>
            </div>

            <div class="flex flex-wrap -mx-4">
                <!-- Mahbub Hossain -->
                <div class="w-full lg:w-1/2 px-4 mb-8">
                    <div class="team-card h-full">
                        <div class="team-card-header">
                            <div class="profile-img-container relative">
                                <div class="profile-glow absolute"></div>
                                <img src="{{ asset('welcome/team/masum.png') }}" class="profile-img rounded-full"
                                    alt="Mahbub Hossain">
                            </div>
                            <h3 class="profile-name">Mahbub Hossain</h3>
                            <div class="profile-title">
                                <span>প্রতিষ্ঠাতা ও ব্যবসায়িক অপারেশনের প্রধান</span>
                            </div>
                            <div class="social-links">
                                <a href="https://www.linkedin.com/in/mhmahbub/" target="_blank">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="https://twitter.com/mhmahbub" target="_blank">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="mailto:mahbub@zengfy.top">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>
                        </div>
                        <div class="team-card-body">
                            <div class="bio-tab-container">
                                <div class="nav-tabs">
                                    <button class="nav-link active" data-tab="mahbub-bn">বাংলা</button>
                                    <button class="nav-link" data-tab="mahbub-en">English</button>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="mahbub-bn">
                                        <p class="bio-text">
                                            মাহবুব হোসেন আমাদের SaaS প্ল্যাটফর্মের ব্যবসায়িক পরিচালনা ও কমপ্লায়েন্সের
                                            দিকটি তত্ত্বাবধান করেন। SSL Wireless এবং Vintage Denim-এর মতো প্রতিষ্ঠানে
                                            কাজ করার তার দীর্ঘ অভিজ্ঞতা, বিশেষ করে রিস্ক ও কমপ্লায়েন্স ব্যবস্থাপনায়
                                            তার গভীর জ্ঞান, আমাদের প্ল্যাটফর্মকে একটি মজবুত ও আইনি ভিত্তি প্রদান করে।
                                            তিনি আমাদের ব্যবসায়িক কৌশল এবং অপারেশনাল দক্ষতা নিশ্চিত করেন।
                                        </p>
                                    </div>
                                    <div class="tab-pane hidden" id="mahbub-en">
                                        <p class="bio-text">
                                            Mahbub Hossain is the CEO & Head of Business Operations. He supervises
                                            business operations and compliance for our SaaS platform. His extensive
                                            experience at SSL Wireless and Vintage Denim, especially in risk and
                                            compliance management, provides our platform with a strong legal foundation.
                                            He ensures our business strategy and operational efficiency.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sazzad Hossain Mahim -->
                <div class="w-full lg:w-1/2 px-4 mb-8">
                    <div class="team-card h-full">
                        <div class="team-card-header">
                            <div class="profile-img-container relative">
                                <div class="profile-glow absolute"></div>
                                <img src="{{ asset('welcome/team/mahim.png') }}" class="profile-img rounded-full"
                                    alt="Sazzad Hossain Mahim">
                            </div>
                            <h3 class="profile-name">Sazzad Hossain Mahim</h3>
                            <div class="profile-title">
                                <span>প্রতিষ্ঠাতা ও প্রধান প্রকৌশলী</span>
                            </div>
                            <div class="social-links">
                                <a href="https://www.linkedin.com/in/sazzadmahim/" target="_blank">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="https://github.com/sazzadmahim" target="_blank">
                                    <i class="bi bi-github"></i>
                                </a>
                                <a href="mailto:mahim@zengfy.top">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>
                        </div>
                        <div class="team-card-body">
                            <div class="bio-tab-container">
                                <div class="nav-tabs">
                                    <button class="nav-link active" data-tab="sazzad-bn">বাংলা</button>
                                    <button class="nav-link" data-tab="sazzad-en">English</button>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="sazzad-bn">
                                        <p class="bio-text">
                                            সাজ্জাদ হোসেন মাহিম আমাদের প্ল্যাটফর্মের প্রযুক্তিগত দিকটির নেতৃত্ব দেন।
                                            একজন প্রতিভাবান ফুল-স্ট্যাক ডেভেলপার হিসেবে তিনি Laravel, Vue.js, এবং
                                            MySQL-এর মতো প্রযুক্তিতে পারদর্শী। তার উদ্ভাবনী দৃষ্টিভঙ্গি এবং গভীর কারিগরি
                                            দক্ষতা আমাদের SaaS সিস্টেমের আর্কিটেকচার, ডিজাইন এবং বাস্তবায়নের
                                            কেন্দ্রবিন্দু। তিনি নিশ্চিত করেন যে আমাদের প্ল্যাটফর্মটি স্কেলেবল, নিরাপদ
                                            এবং ব্যবহারকারী-বান্ধব।
                                        </p>
                                    </div>
                                    <div class="tab-pane hidden" id="sazzad-en">
                                        <p class="bio-text">
                                            Sazzad Hossain Mahim is the Founder & Principal Engineer. He leads the
                                            technical aspects of our platform. As a talented full-stack developer, he is
                                            proficient in Laravel, Vue.js, and MySQL. His innovative vision and deep
                                            technical expertise are central to the architecture, design, and
                                            implementation of our SaaS system. He ensures our platform is scalable,
                                            secure, and user-friendly.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fixed Bottom Navbar (Mobile Only) -->
    <div class="fixed-navbar">
        <a href="{{ route('welcome') }}" class="nav-item">
            <div class="nav-icon">🏠</div>
            <div class="nav-text">হোম</div>
        </a>
        <a href="{{ route('team') }}" class="nav-item active">
            <div class="nav-icon">👥</div>
            <div class="nav-text">টীম</div>
        </a>
        <a href="{{ route('team') }}" class="nav-item">
            <div class="nav-icon">📞</div>
            <div class="nav-text">যোগাযোগ</div>
        </a>
        <a href="{{ route('signup') }}" class="nav-item">
            <div class="nav-icon">📝</div>
            <div class="nav-text">সাইন আপ</div>
        </a>
    </div>

    <script>
        // Tab functionality
        document.querySelectorAll('.nav-link').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs in this tab container
                const tabContainer = this.closest('.bio-tab-container');
                tabContainer.querySelectorAll('.nav-link').forEach(t => t.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');

                // Hide all tab panes in this container
                const tabContent = tabContainer.querySelector('.tab-content');
                tabContent.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));

                // Show the selected pane
                const targetPane = tabContent.querySelector('#' + this.dataset.tab);
                targetPane.classList.remove('hidden');
            });
        });

        // Language switcher functionality
        const btnBn = document.getElementById('btn-bn');
        const btnEn = document.getElementById('btn-en');

        btnBn.addEventListener('click', function() {
            btnBn.classList.add('active');
            btnEn.classList.remove('active');

            // Activate Bengali tabs for all team members
            document.querySelectorAll('.nav-link[data-tab$="bn"]').forEach(tab => {
                tab.classList.add('active');
                const tabContainer = tab.closest('.bio-tab-container');
                tabContainer.querySelectorAll('.nav-link[data-tab$="en"]').forEach(t => t.classList.remove(
                    'active'));

                // Show Bengali panes, hide English ones
                const tabContent = tabContainer.querySelector('.tab-content');
                tabContent.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));
                tabContent.querySelectorAll('[id$="bn"]').forEach(pane => pane.classList.remove('hidden'));
            });
        });

        btnEn.addEventListener('click', function() {
            btnEn.classList.add('active');
            btnBn.classList.remove('active');

            // Activate English tabs for all team members
            document.querySelectorAll('.nav-link[data-tab$="en"]').forEach(tab => {
                tab.classList.add('active');
                const tabContainer = tab.closest('.bio-tab-container');
                tabContainer.querySelectorAll('.nav-link[data-tab$="bn"]').forEach(t => t.classList.remove(
                    'active'));

                // Show English panes, hide Bengali ones
                const tabContent = tabContainer.querySelector('.tab-content');
                tabContent.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));
                tabContent.querySelectorAll('[id$="en"]').forEach(pane => pane.classList.remove('hidden'));
            });
        });

        // Mobile navbar active state
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
