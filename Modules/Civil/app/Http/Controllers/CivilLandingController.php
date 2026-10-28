<?php

namespace Modules\Civil\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CivilLandingController extends Controller
{
    /**
     * Provide comprehensive telemetry payload for Zengfy Civil.
     */
    protected function getCivilData(): array
    {
        $baseDomain = config('app.base_domain', 'zengfy.top');
        $port = config('app.port', 8000);
        $protocol = request()->secure() ? 'https://' : 'http://';
        $portSuffix = ($port && !in_array($port, [80, 443])) ? ":{$port}" : '';

        return [
            'brand' => [
                'name' => 'Zengfy Civil',
                'subdomain' => 'civil',
                'badge' => '🇧🇩 Bangladesh Sovereign 3D Architecture & Costing ERP',
                'tagline' => '3D Land Architecture & Construction Costing Hub',
                'tagline_bn' => 'সিভিল আর্কিটেক্ট ও কন্সট্রাকশন ফার্মের জন্য ৩ডি প্লট ভিজ্যুয়ালাইজার ও ম্যাটেরিয়াল কস্টিং ইআরপি।',
                'description' => 'যেকোনো জমির ৩ডি আইসোমেট্রিক এলিভেশন, রাজউক/পৌরসভা ড্রয়িং ভল্ট এবং লাইভ রড-সিমেন্ট বাজারদর ভিত্তিক ১০০% নির্ভুল কন্সট্রাকশন কস্টিং স্যুট।',
            ],
            'stats' => [
                'active_engineering_firms' => '620+',
                'rendered_3d_plots' => '18,500+',
                'materials_estimated_bdt' => '৳450 Cr+',
                'districts_covered' => '64 Districts',
                'costing_accuracy' => '99.8%',
            ],
            'business_model' => [
                'type' => 'Strictly SaaS Cloud Subscription',
                'note' => 'ক্লাউড সাবস্ক্রিপশন প্ল্যাটফর্ম — জিরো হার্ডওয়্যার বা সার্ভার সেটআপ ঝামেলা, সরাসরি ব্রাউজারে ৩ডি মডেল শোকেস।',
            ],
            'simulator' => [
                'sample_plots' => [
                    [
                        'id' => 'plot_3katha',
                        'name' => '৩ কাঠা (Residential Plot)',
                        'location' => 'বসুন্ধরা আবাসিক এলাকা (ব্লক-এল)',
                        'katha' => 3,
                        'sqft' => 2160,
                        'far_limit' => 3.75,
                        'max_built_area' => 8100,
                        'setback' => 'সামনে ৫ ফুট, পেছনে ও পাশে ৩ ফুট',
                    ],
                    [
                        'id' => 'plot_5katha',
                        'name' => '৫ কাঠা (Duplex Villa / Residential)',
                        'location' => 'উত্তরা সেক্টর ১১, ঢাকা',
                        'katha' => 5,
                        'sqft' => 3600,
                        'far_limit' => 4.00,
                        'max_built_area' => 14400,
                        'setback' => 'সামনে ৬ ফুট, পেছনে ৫ ফুট, পাশে ৩.৫ ফুট',
                    ],
                    [
                        'id' => 'plot_10katha',
                        'name' => '১০ কাঠা (Commercial / High-Rise)',
                        'location' => 'ধানমন্ডি রোড ২৭, ঢাকা',
                        'katha' => 10,
                        'sqft' => 7200,
                        'far_limit' => 5.25,
                        'max_built_area' => 37800,
                        'setback' => 'সামনে ১০ ফুট, পেছনে ৬ ফুট, পাশে ৫ ফুট',
                    ],
                ],
                'design_presets' => [
                    [
                        'id' => 'duplex_villa',
                        'name' => 'মডার্ন ডুপ্লেক্স ভিলা (Modern Duplex Villa)',
                        'type' => 'Duplex Luxury',
                        'total_sqft' => 3500,
                        'floors' => 2,
                        'bedrooms' => 5,
                        'bathrooms' => 5,
                        'parking' => 2,
                        'steel_ton' => 14.5,
                        'cement_bags' => 1250,
                        'bricks_count' => 42000,
                        'sand_cft' => 5800,
                        'finish_cost_ratio' => 0.45,
                    ],
                    [
                        'id' => 'multi_storey',
                        'name' => '৭ তলা রেসিডেন্সিয়াল অ্যাপার্টমেন্ট (7-Storey Residential Complex)',
                        'type' => 'Multi-Family Apartment',
                        'total_sqft' => 10200,
                        'floors' => 7,
                        'units' => 6,
                        'bedrooms' => 18,
                        'bathrooms' => 18,
                        'parking' => 6,
                        'steel_ton' => 48.0,
                        'cement_bags' => 4200,
                        'bricks_count' => 135000,
                        'sand_cft' => 18500,
                        'finish_cost_ratio' => 0.48,
                    ],
                ],
                'material_rates' => [
                    'steel_per_ton' => 95000,
                    'cement_per_bag' => 540,
                    'brick_per_piece' => 14,
                    'sand_per_cft' => 48,
                    'labor_rate_sqft' => 320,
                    'currency' => 'BDT',
                    'updated_at' => 'আজকের বাজারদর (লাইভ ঢাকা মার্কেট)',
                ],
            ],
            'stakeholder_journeys' => [
                [
                    'id' => 'architect',
                    'role' => 'চিফ আর্কিটেক্ট (Chief Architect)',
                    'tagline' => 'রাজউক/পৌরসভা ড্রয়িং ও ক্লায়েন্টকে ৩ডি ভিজ্যুয়ালাইজেশন প্রদর্শন',
                    'icon' => '📐',
                    'color' => 'cyan',
                    'quote' => 'ক্লায়েন্টকে সাধারণ ২ডি ব্লুপ্রিন্ট দেখালে তারা বাড়ি কল্পনা করতে পারে না। Zengfy Civil-এর ৩ডি আইসোমেট্রিকে ক্লায়েন্ট সাথে সাথেই ডিজাইন সাইন-অফ করে।',
                    'features' => [
                        'যেকোনো ক্যাড (DWG/DXF) ফাইল থেকে স্বয়ংক্রিয় ৩ডি ভলিউম জেনারেশন',
                        'রাজউক ফার (FAR) ও ব্যাক-সেটব্যাক রুলসের ইনস্ট্যান্ট কমপ্লায়েন্স ভ্যালিডেশন',
                        'ক্লায়েন্ট মোড: ইন্টারঅ্যাক্টিভ ৩৬০° ক্যামেরা রোটেশন ও সানলাইট শ্যাডো সিমুলেশন',
                        'হাই-রেজোলিউশন ৪K এলিভেশন প্রেজেন্টেশন ও ব্লুপ্রিন্ট এক্সপোর্ট',
                    ],
                ],
                [
                    'id' => 'site_engineer',
                    'role' => 'সাইট সিভিল ইঞ্জিনিয়ার (Site Civil Engineer)',
                    'tagline' => 'রড-সিমেন্ট-বালু স্টিমেট ও ডেইলি সাইট ম্যাটেরিয়াল লেজার',
                    'icon' => '👷',
                    'color' => 'blue',
                    'quote' => 'কাস্টিংয়ের দিন যেন এক বস্তা সিমেন্ট বা ১ কেজি রডেরও ঘাটতি না হয়—মোবাইলেই সাইট স্টক ও ম্যাটেরিয়াল চালানের ১০০% ট্র্যাক থাকে।',
                    'features' => [
                        'গ্রেড ভিত্তিক বিম, কলাম ও স্ল্যাব রড কাটিং লিস্ট (BBS Auto Engine)',
                        'দৈনিক সিমেন্ট ব্যাচিং ও কিউব টেস্ট কোয়ালিটি রিপোর্ট তৈরি',
                        'সাইট ডেলিভারি চালান ও ট্রাক আনলোডিং ডিজিটাল রসিদ',
                        'অফলাইন সাইট মোড: ইন্টারনেটের অনুপস্থিতিতেও খরচ এন্ট্রি',
                    ],
                ],
                [
                    'id' => 'firm_owner',
                    'role' => 'কন্সট্রাকশন ফার্ম ওনার (Construction Firm Owner)',
                    'tagline' => 'ক্লায়েন্ট কোটেশন ও নিট প্রজেক্ট মার্জিন ড্যাশবোর্ড',
                    'icon' => '🏢',
                    'color' => 'slate',
                    'quote' => 'রডের দাম টন প্রতি ২ হাজার টাকা বাড়লে আমার টোটাল প্রজেক্ট মার্জিনে কী প্রভাব পড়বে, তা ১ ক্লিকেই প্রজেকশন শিটে দেখতে পারি।',
                    'features' => [
                        'লাইভ ম্যাটেরিয়াল প্রাইস অ্যালার্ট ও ডাইনামিক প্রজেক্ট রি-কস্টিং',
                        'ক্লায়েন্টদের জন্য প্রফেশনাল ব্রanded কোটেশন ও পেমেন্ট শিডিউল বিলিং',
                        'মাল্টিপল সাইট প্রগ্রেস ট্র্যাকিং ও ইঞ্জিনিয়ার পারফরম্যান্স ড্যাশবোর্ড',
                        'সাব-কন্ট্রাক্টর ও লেবার সর্দার পেমেন্ট লেজার',
                    ],
                ],
                [
                    'id' => 'landowner',
                    'role' => 'জমি মালিক ও ক্লায়েন্ট (Landowner Client)',
                    'tagline' => 'নিজের জমিতে বাড়ি কেমন হবে তা ৩ডি-তে দেখে শতভাগ নিশ্চিত হওয়া',
                    'icon' => '🏡',
                    'color' => 'emerald',
                    'quote' => 'জীবনের সঞ্চয় দিয়ে বাড়ি বানাচ্ছি। কাজ শুরুর আগেই ড্রয়িং ও মালামালের আসল খরচ স্বচ্ছভাবে দেখে মনে গভীর শান্তি পেয়েছি।',
                    'features' => [
                        'ক্লাউড লিংকের মাধ্যমে যেকোনো ল্যাপটপ বা মোবাইলে নিজের বাড়ির ৩ডি ভিউ',
                        'ম্যাটেরিয়াল ব্যয়ের স্বচ্ছ ব্রেকডাউন (রড, সিমেন্ট, ইট ও টাইলস)',
                        'কন্সট্রাকশন কাজের মাইলস্টোন ফটো আপডেট ও ডিজিটাল বিল অডিট',
                        'ফার্মের সাথে সরাসরি চ্যাটে চেঞ্জ রিকোয়েস্ট ও অনুমোদন',
                    ],
                ],
            ],
            'architecture_pillars' => [
                [
                    'id' => 'gis_engine',
                    'title' => '৩ডি ল্যান্ড জিআইএস রেন্ডারিং ইঞ্জিন',
                    'subtitle' => 'ইনস্ট্যান্ট ৩ডি আইসোমেট্রিক প্লট ও এলিভেশন মডেল',
                    'desc' => 'জমির কাঠা বা শতকের মাপ দিলেই আমাদের ক্লাউড ইঞ্জিন স্বয়ংক্রিয়ভাবে ৩ডি আইসোমেট্রিক ল্যান্ডস্কেপ, ফ্লোর লেআউট এবং এক্সটেরিয়র এলিভেশন জেনারেট করে।',
                    'icon' => 'cubes',
                    'metric' => '৬০ FPS WebGL রেন্ডারিং',
                ],
                [
                    'id' => 'costing_algo',
                    'title' => 'ডায়নামিক ম্যাটেরিয়াল কস্টিং অ্যালগরিদম',
                    'subtitle' => 'রড, সিমেন্ট, ইট ও বালুর বাজারদর ভিত্তিক স্টিমেট',
                    'desc' => 'বাংলাদেশের বর্তমান বাজারদরের সাথে সরাসরি কানেক্টেড। স্ট্রাকচারাল ফ্রেম ও ফিনিশিং কাজের ম্যাটেরিয়াল ও লেবার ব্যয়ের নির্ভুল বিওকিউ (BOQ) প্রস্তুতকারক।',
                    'icon' => 'calculator',
                    'metric' => '৯৯.৮% নির্ভুল কস্টিং শিট',
                ],
                [
                    'id' => 'compliance_draft',
                    'title' => 'রাজউক ও পৌরসভা কমপ্লায়েন্স ড্রাফটার',
                    'subtitle' => 'বিএনবিসি (BNBC) বিল্ডিং কোড ও ফার (FAR) ক্যালকুলেশন',
                    'desc' => 'রাস্তার প্রস্থ ও প্লটের মাপ অনুযায়ী সর্বোচ্চ অনুমোদনযোগ্য তলা, পার্কিং রিকোয়ারমেন্ট এবং ব্যাক/সাইড সেটব্যাকের স্বয়ংক্রিয় রিপোর্ট প্রদান।',
                    'icon' => 'file-check',
                    'metric' => '১০০% বিএনবিসি কমপ্লায়েন্ট',
                ],
                [
                    'id' => 'vault',
                    'title' => 'সার্বভৌম সিভিল প্রজেক্ট ভল্ট',
                    'subtitle' => 'আর্কিটেকচারাল ক্যাড ও সয়েল টেস্ট রেকর্ডের নিরাপদ ক্লাউড',
                    'desc' => 'ক্লায়েন্টের স্ট্রাকচারাল ড্রইং, মাটির টেস্ট রিপোর্ট, প্লাম্বিং ও ইলেকট্রিক্যাল লেআউট সুরক্ষিত ব্যাংকিং-গ্রেড ২৫৬-বিট ক্লায়েন্ট এনক্রিপশনে সংরক্ষিত।',
                    'icon' => 'shield-lock',
                    'metric' => '২৫৬-বিট ক্লাউড এনক্রিপশন',
                ],
            ],
            'commercial_offers' => [
                [
                    'id' => 'studio_cloud',
                    'name' => 'আর্কিটেক্ট স্টুডিও ক্লাউড',
                    'badge' => 'ছোট আর্কিটেক্ট ও ডিজাইন স্টুডিও',
                    'price' => '৳৩,০০০',
                    'billing' => '/ মাস (ক্লাউড সাবস্ক্রিপশন)',
                    'popular' => false,
                    'summary' => 'ব্যক্তিগত আর্কিটেক্ট ও ছোট কনসালটেন্সি ফার্মের জন্য আনলিমিটেড ৩ডি প্লট শোকেস ও ক্লায়েন্ট প্রেজেন্টেশন হাব।',
                    'features' => [
                        'আনলিমিটেড ৩ডি প্লট ভিজ্যুয়ালাইজেশন ও আইসোমেট্রিক মডেলিং',
                        'রাজউক ও পৌরসভা সেটব্যাক/ফার (FAR) ক্যালকুলেটর',
                        'ক্লায়েন্ট প্রেজেন্টেশন মোড (ইন্টারঅ্যাক্টিভ ৩ডি ওয়েব লিংক)',
                        'সর্বোচ্চ ৩ জন ড্রাফটসম্যান ও আর্কিটেক্টের টিম অ্যাক্সেস',
                        '১০ জিবি ক্লাউড ড্রয়িং ভল্ট (DWG, DXF, PDF ফাইল)',
                        'প্রজেক্ট পিছু হাই-রেজ ৪K এলিভেশন রেন্ডার এক্সপোর্ট',
                    ],
                    'cta' => 'স্টুডিও ক্লাউড শুরু করুন',
                ],
                [
                    'id' => 'firm_pro',
                    'name' => 'কন্সট্রাকশন ফার্ম প্রো',
                    'badge' => 'সর্বাধিক ব্যবহৃত প্রফেশনাল প্যাকেজ',
                    'price' => '৳৬,০০০',
                    'billing' => '/ মাস (ক্লাউড সাবস্ক্রিপশন)',
                    'popular' => true,
                    'summary' => 'কন্সট্রাকশন কোম্পানি, সিভিল ইঞ্জিনিয়ারিং ফার্ম ও সাইট ম্যানেজমেন্ট টিমের জন্য পূর্ণাঙ্গ সাইট ও কস্টিং ইআরপি।',
                    'features' => [
                        'স্টুডিও ক্লাউডের সকল ফিচার অন্তর্ভুক্ত',
                        'লাইভ রড, সিমেন্ট, ইট ও বালু কস্টিং ইঞ্জিন (BOQ Generator)',
                        'আনলিমিটেড সাইট সিভিল ইঞ্জিনিয়ার ও ফিল্ড সুপারভাইজার অ্যাকাউন্ট',
                        'ডেইলি সাইট ম্যাটেরিয়াল কনসাম্পশন ও স্টক লেজার',
                        'রড কাটিং লিস্ট বার বেন্ডিং শিডিউল (BBS Engine)',
                        'লেবার ও সাব-কন্ট্রাক্টর পে-রোল ম্যানেজমেন্ট',
                        '৫০ জিবি হাই-স্পিড ক্লাউড স্টোরেজ ও ডেইলি ব্যাকআপ',
                        'অগ্রাধিকার ভিত্তিতে ফোন ও হোয়াটসঅ্যাপ ইঞ্জিনিয়ার সাপোর্ট',
                    ],
                    'cta' => 'ফার্ম প্রো ট্রায়াল নিন',
                ],
                [
                    'id' => 'enterprise',
                    'name' => 'মেগা ডেভেলপার এন্টারপ্রাইজ',
                    'badge' => 'রিয়েল এস্টেট ডেভেলপার ও টাউনশিপ',
                    'price' => 'Contact Sales',
                    'billing' => 'কাস্টম বাৎসরিক চুক্তি (Dedicated SaaS)',
                    'popular' => false,
                    'summary' => 'বড় রিয়েল এস্টেট ডেভেলপার কোম্পানি, টাউনশিপ ও মেগা ইনফ্রাস্ট্রাকচার প্রজেক্টের জন্য এন্টারপ্রাইজ ক্লাউড স্যুট।',
                    'features' => [
                        'ফার্ম প্রো-এর সকল ফিচার সহ আনলিমিটেড মাল্টি-টাউনশিপ স্কেলিং',
                        'কাস্টম সাবডোমেইন ও ফার্মের নিজস্ব ব্র্যান্ডেড ক্লায়েন্ট পোর্টাল',
                        'মাল্টিপল প্রজেক্ট বাজেট ও কর্পোরেট প্রফিট মার্জিন অডিট',
                        'সরাসরি অ্যাকাউন্টিং ও প্রোফিউরমেন্ট সাপ্লাই চেইন ইন্টিগ্রেশন',
                        'ডেডিকেটেড ক্লাউড ইন্সট্যান্স ও ৯৯.৯৯% আপটাইম SLA',
                        'অন-প্রিমিসেস / ডেডিকেটেড ভিপিএস ক্লাউড ডেপ্লয়মেন্ট অপশন',
                        'ডেডিকেটেড একাউন্ট ম্যানেজার ও অন-সাইট ইঞ্জিনিয়ার ট্রেনিং',
                    ],
                    'cta' => 'এন্টারপ্রাইজ কনসালটেশন নিন',
                ],
            ],
            'faq' => [
                [
                    'q' => 'Zengfy Civil-এ কোনো এককালীন (One-Time) লাইসেন্স ফি আছে কি?',
                    'a' => 'না, Zengfy Civil সম্পূর্ণ SaaS (Software as a Service) ক্লাউড সাবস্ক্রিপশন মডেলে পরিচালিত। ফলে কোনো ভারি সার্ভার ক্রয়, জটিল ইন্সটলেশন বা রক্ষণাবেক্ষণের বাড়তি খরচ নেই। আপনি যেকোনো ডিভাইসের ব্রাউজার থেকে সরাসরি লগইন করে সেবাটি ব্যবহার করতে পারবেন।',
                ],
                [
                    'q' => '৩ডি প্লট রেন্ডারিং করতে কি দামি গ্রাফিক্স কার্ড বা উচ্চগতির পিসির প্রয়োজন?',
                    'a' => 'একদমই না! আমাদের ৩ডি রেন্ডারিং ইঞ্জিন ক্লাউড-অপ্টিমাইজড ওয়েবজিএল (WebGL) আর্কিটেকচারে চলে। তাই সাধারণ ল্যাপটপ, ট্যাবলেট বা যেকোনো স্মার্টফোনেই অনায়াসে ৬০ FPS মসৃণ ৩ডি মডেল ও ফ্লোরপ্ল্যান ক্লায়েন্টকে ঘুরিয়ে দেখানো সম্ভব।',
                ],
                [
                    'q' => 'লাইভ ম্যাটেরিয়াল রেট কীভাবে আপডেট হয়?',
                    'a' => 'আমাদের সিস্টেমে প্রতিদিনের বাংলাদেশের পাইকারি ও খুচরা বাজারদর (রড, সিমেন্ট, অটো ব্রিক ও সিলেট বালু) নিয়মিত আপডেট থাকে। তাছাড়া ফার্ম চাইলে প্রজেক্টের জন্য তাদের নিজস্ব স্পেশাল রেটও সেভ করে রাখতে পারে।',
                ],
                [
                    'q' => 'রাজউক এবং সিটি কর্পোরেশনের বিল্ডিং নিয়মনীতি কি এতে মেনে চলা হয়?',
                    'a' => 'হ্যাঁ, আমাদের অ্যালগরিদম বাংলাদেশ ন্যাশনাল বিল্ডিং কোড (BNBC) এবং রাজউক/সিডিএ/আরডিএ-এর ফার (Floor Area Ratio - FAR) ও সেটব্যাক রুলস অনুযায়ী স্বয়ংক্রিয় হিসাব প্রদান করে।',
                ],
            ],
            'auth' => [
                'is_authenticated' => auth()->check(),
                'user' => auth()->user(),
            ],
            'links' => [
                'home' => "{$protocol}civil.{$baseDomain}{$portSuffix}/",
                'login' => "{$protocol}accounts.{$baseDomain}{$portSuffix}/login?continue=" . urlencode("{$protocol}civil.{$baseDomain}{$portSuffix}/"),
                'register' => "{$protocol}accounts.{$baseDomain}{$portSuffix}/register?continue=" . urlencode("{$protocol}civil.{$baseDomain}{$portSuffix}/"),
                'download' => 'https://github.com/diusazzad/zengfy/releases',
                'master_landing' => "{$protocol}{$baseDomain}{$portSuffix}/",
                'social' => "{$protocol}social.{$baseDomain}{$portSuffix}/",
                'school' => "{$protocol}school.{$baseDomain}{$portSuffix}/",
                'pos' => "{$protocol}pos.{$baseDomain}{$portSuffix}/",
                'law' => "{$protocol}law.{$baseDomain}{$portSuffix}/",
                'api_docs' => "{$protocol}civil.{$baseDomain}{$portSuffix}/api/v1/civil/landing",
            ],
        ];
    }

    /**
     * Display the Civil landing page.
     */
    public function index(Request $request): View
    {
        $initialData = $this->getCivilData();

        return view('civil::landing', compact('initialData'));
    }

    /**
     * Public REST API endpoint for Civil Landing data.
     */
    public function data(Request $request): JsonResponse
    {
        $data = $this->getCivilData();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'data' => $data,
        ], 200, [
            'Cache-Control' => 'max-age=300, public, stale-while-revalidate=86400',
        ]);
    }
}
