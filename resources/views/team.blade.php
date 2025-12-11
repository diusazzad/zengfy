<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zengfy | টীম</title>
    <meta name="description" content="Zengfy-এর টীমে যারা SaaS, ব্যবসা ও প্রযুক্তি নিয়ে কাজ করে। স্থানীয় টীমের সাথে পরিচিত হোন।">
    <meta name="robots" content="index, follow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { bn: ['"Noto Sans Bengali"', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Noto Sans Bengali', sans-serif; background: #f8fafc; }
        .fade-up { opacity: 0; transform: translateY(24px); animation: fadeUp 0.6s ease forwards; }
        .fade-up:nth-child(1) { animation-delay: 0.1s; }
        .fade-up:nth-child(2) { animation-delay: 0.2s; }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="text-gray-800">
    @php
        $team = [
            [
                'name' => 'Mahbub Hossain',
                'role_bn' => 'প্রতিষ্ঠাতা ও ব্যবসায়িক অপারেশনের প্রধান',
                'role_en' => 'Founder & Head of Business Operations',
                'location' => 'ঢাকা, বাংলাদেশ',
                'image' => asset('welcome/team/masum.png'),
                'linkedin' => 'https://www.linkedin.com/in/mhmahbub/',
                'twitter' => 'https://twitter.com/mhmahbub',
                'email' => 'mahbub@zengfy.top',
                'bio_bn' => 'Mahbub Zengfy-এর ব্যবসায়িক কৌশল, অংশীদারিত্ব ও কাস্টমার সাকসেস পরিচালনা করেন। স্থানীয় সম্পর্ক ও data-driven সিদ্ধান্ত প্ল্যাটফর্মকে নির্ভরযোগ্য রাখে।',
                'bio_en' => 'Mahbub steers Zengfy\'s business strategy, partnerships, and customer success. His focus on local relationships and data-driven decision making keeps the SaaS experience reliable and grounded in Bangladesh.',
            ],
            [
                'name' => 'Sazzad Hossain Mahim',
                'role_bn' => 'প্রধান প্রকৌশলী ও প্ল্যাটফর্ম আর্কিটেক্ট',
                'role_en' => 'Principal Engineer & Platform Architect',
                'location' => 'ঢাকা, বাংলাদেশ',
                'image' => asset('welcome/team/mahim.png'),
                'linkedin' => 'https://www.linkedin.com/in/sazzadmahim',
                'twitter' => 'https://twitter.com/sazzadmahim',
                'email' => 'mahim@zengfy.top',
                'bio_bn' => 'Sazzad Zengfy-এর SaaS আর্কিটেকচার ডিজাইন করেন। Laravel, Vue.js ও MySQL-এ অভিজ্ঞ তিনি ক্লাউড সিকিউরিটি ও স্কেলযোগ্য ডিজাইন বাস্তবায়ন করেন।',
                'bio_en' => 'Sazzad designs Zengfy\'s SaaS architecture. With deep experience in Laravel, Vue.js, and MySQL, he applies cloud security and scalable design practices that customers rely on every day.',
            ],
        ];
    @endphp

    <header class="bg-white shadow sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('welcome') }}" class="text-2xl font-extrabold text-blue-600">Zengfy</a>
            <nav class="flex flex-wrap items-center gap-3 text-sm sm:text-base">
                <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-blue-600">হোম</a>
                <a href="{{ route('team') }}" class="text-blue-600 font-semibold">টীম</a>
                <a href="{{ route('download.app') }}" class="text-gray-600 hover:text-blue-600">অ্যাপ ডাউনলোড</a>
                <a href="{{ route('faq') }}" class="text-gray-600 hover:text-blue-600">FAQ</a>
                <a href="{{ route('signup') }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded font-semibold hover:bg-yellow-300">সাইন আপ</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="bg-gradient-to-br from-blue-600 to-green-500 text-white py-16 px-4">
            <div class="max-w-6xl mx-auto flex flex-col lg:flex-row items-center gap-10">
                <div class="flex-1 space-y-6">
                    <p class="text-sm uppercase tracking-[0.5em] text-white/80">Meet the faces behind Zengfy</p>
                    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">বাংলাদেশের SaaS টিম, যাদের অভিজ্ঞতা আপনার ব্যবসাকে গড়ে তোলে।</h1>
                    <p class="text-lg text-white/90">আমরা ব্যবসার উপর ভিত্তি করে সিদ্ধান্ত নেই, লোকাল দলের সাহায্যে উন্নয়ন ও সাপোর্ট চালাই, এবং নিরাপত্তার দিকটি গুরুত্ব দিয়ে API ও পেমেন্ট অটোমেশন তৈরি করি।</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('signup') }}" class="bg-white text-gray-900 px-6 py-3 rounded-full font-semibold shadow-lg hover:bg-gray-100 transition w-full sm:w-auto text-center">টীমের সাথে যোগাযোগ</a>
                        <a href="{{ route('team') }}#team-section" class="border border-white/70 px-6 py-3 rounded-full font-semibold hover:border-white transition w-full sm:w-auto text-center">পুরো টীম দেখুন</a>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="bg-white/10 border border-white/30 rounded-3xl p-6 backdrop-blur">
                        <p class="text-sm text-white/70 mb-2">দ্রুত ফ্যাক্ট</p>
                        <ul class="space-y-2 text-white font-medium">
                            <li>• ৫০০+ Verified ব্যবসা</li>
                            <li>• ২৪/৭ স্থানীয় সাপোর্ট</li>
                            <li>• ৯৫% SLA অনলাইন সময়</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="team-section" class="max-w-6xl mx-auto px-4 py-12">
            <div class="text-center mb-10">
                <p class="text-sm uppercase tracking-[0.4em] text-gray-400 mb-2">Leadership</p>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">প্রফেশনাল অভিজ্ঞতা ও বাস্তব অভিজ্ঞতা</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-3">LinkedIn থেকে প্রাপ্ত অভিজ্ঞতা ও দক্ষতা দিয়ে আমরা প্রতিদিন SaaS সলিউশন উন্নয়ন ও স্বয়ংক্রিয়তা দিকে এগিয়ে যাই।</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($team as $member)
                    <article class="bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col transition hover:-translate-y-1 hover:shadow-2xl fade-up">
                        <div class="bg-gradient-to-br from-indigo-500 to-blue-600 p-6 text-white flex flex-col gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-full bg-white/30 border border-white/40 overflow-hidden">
                                    <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold">{{ $member['name'] }}</h3>
                                    <p class="text-sm text-white/80">{{ $member['role_bn'] }}</p>
                                </div>
                            </div>
                            <p class="text-sm text-white/80 flex flex-wrap gap-2 items-center">
                                <span class="px-3 py-1 rounded-full bg-white/20">{{ $member['location'] }}</span>
                                <span class="border border-white/40 px-3 py-1 rounded-full text-white/70 text-xs">{{ $member['role_en'] }}</span>
                            </p>
                            <div class="flex gap-3 text-lg">
                                <a href="{{ $member['linkedin'] }}" target="_blank" aria-label="LinkedIn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.94 8.5H3V21h3.94V8.5zm.06-5.5A2.44 2.44 0 0 1 10.44 5a2.4 2.4 0 0 1-2.44 2.44A2.42 2.42 0 0 1 5.56 5 2.44 2.44 0 0 1 7 3zM21 21h-3.94v-5.72c0-1.37-.49-2.3-1.71-2.3a1.85 1.85 0 0 0-1.74 1.23 2.53 2.53 0 0 0-.12.84V21H9.54s.05-8.96 0-9.9H13v1.4h.05a3.86 3.86 0 0 1 3.51-1.92c2.57 0 4.5 1.69 4.5 5.32z"/></svg>
                                </a>
                                <a href="{{ $member['twitter'] }}" target="_blank" aria-label="Twitter">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21 6.5a6.27 6.27 0 0 1-1.83.5 3.17 3.17 0 0 0 1.4-1.74 6.3 6.3 0 0 1-2 .75A3.15 3.15 0 0 0 14.5 5a3.13 3.13 0 0 0-3.14 3.17 2.53 2.53 0 0 0 .08.72 8.94 8.94 0 0 1-6.5-3.34 3.08 3.08 0 0 0-.43 1.6 3.12 3.12 0 0 0 1.42 2.74 3.38 3.38 0 0 1-1.41-.39v.04a3.16 3.16 0 0 0 2.5 3.09 3.54 3.54 0 0 1-.83.1c-.2 0-.4-.01-.59-.05a3.17 3.17 0 0 0 2.96 2.18 6.33 6.33 0 0 1-4.36 1.5A5.16 5.16 0 0 1 3 18.21 8.88 8.88 0 0 0 7.17 20c6.17 0 9.55-5 9.55-9.35v-.43A6.63 6.63 0 0 0 21 6.5z"/></svg>
                                </a>
                                <a href="mailto:{{ $member['email'] }}" aria-label="Email">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 2v.51L12 11l-8-4.5V6zM4 18V8.5l8 4.5 8-4.5V18z"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="p-6 space-y-3 flex-1 flex flex-col bg-white">
                            <p class="text-gray-900 text-lg font-semibold">প্রোফেশনাল বায়ো</p>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $member['bio_bn'] }}</p>
                            <p class="text-gray-500 text-xs uppercase tracking-[0.4em]">English summary</p>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $member['bio_en'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="bg-white py-12 px-4">
            <div class="max-w-6xl mx-auto rounded-3xl border border-gray-200 p-8 text-center space-y-4">
                <p class="text-sm uppercase tracking-[0.6em] text-gray-400">Get in touch</p>
                <h3 class="text-3xl font-bold text-gray-900">একসাথে Zengfy-র ভবিষ্যৎ তৈরি করি</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">বাংলাদেশের যে কোন সেক্টর থেকে হোক, আপনার ব্যবসা বা প্রতিষ্ঠানকে ডিজিটাল রূপান্তরে নিয়ে যেতে আমাদের লোকাল টিম প্রস্তুত।</p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('signup') }}" class="px-6 py-3 rounded-full bg-blue-600 text-white font-semibold hover:bg-blue-500 transition">সাইন আপ</a>
                    <a href="mailto:team@zengfy.top" class="px-6 py-3 rounded-full border border-gray-300 text-gray-700 hover:border-gray-400">ইমেইল করুন</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-6xl mx-auto px-4 grid gap-6 md:grid-cols-2">
            <div>
                <h4 class="font-semibold text-lg">Zengfy</h4>
                <p class="text-gray-300 text-sm">বাংলাদেশের জন্য নির্মিত ইউনিফাইড SaaS প্ল্যাটফর্ম। শক্তিশালী টিম দিয়ে ব্যবসার প্রতিদিনের কাজ সহজ করি।</p>
            </div>
            <div class="flex flex-wrap gap-4 text-sm">
                <a href="{{ route('welcome') }}" class="hover:text-blue-300">হোম</a>
                <a href="{{ route('team') }}" class="hover:text-blue-300">টীম</a>
                <a href="{{ route('download.app') }}" class="hover:text-blue-300">অ্যাপ ডাউনলোড</a>
                <a href="{{ route('faq') }}" class="hover:text-blue-300">FAQ</a>
                <a href="{{ route('signup') }}" class="hover:text-blue-300">সাইন আপ</a>
                <a href="mailto:team@zengfy.top" class="hover:text-blue-300">team@zengfy.top</a>
            </div>
        </div>
    </footer>
</body>
</html>
