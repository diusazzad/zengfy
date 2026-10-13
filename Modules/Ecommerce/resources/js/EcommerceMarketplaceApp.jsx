import React, { useState } from 'react';
import MarketplaceNavbar from './components/MarketplaceNavbar';
import PromoBanners from './components/PromoBanners';
import TrustGuarantees from './components/TrustGuarantees';
import CategoryPills from './components/CategoryPills';
import FlashDeals from './components/FlashDeals';
import OfficialStores from './components/OfficialStores';
import ProductFeed from './components/ProductFeed';
import DarazComparisonTable from './components/DarazComparisonTable';
import CartDrawer from './components/CartDrawer';
import MarketplaceFooter from './components/MarketplaceFooter';

export default function EcommerceMarketplaceApp({ initialData }) {
    const data = initialData || {};

    const [cartItems, setCartItems] = useState([
        // Initial sample item for quick test
        {
            id: 'fs-1',
            title: 'T900 Ultra 2 Smartwatch (HD Full Touch)',
            price: 1350,
            quantity: 1,
            seller: { name: 'TechZone BD' },
            image: 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=600&auto=format&fit=crop&q=80'
        }
    ]);
    const [cartOpen, setCartOpen] = useState(false);
    const [searchQuery, setSearchQuery] = useState('');
    const [selectedCategory, setSelectedCategory] = useState('all');
    const [toastMessage, setToastMessage] = useState(null);

    const showToast = (msg) => {
        setToastMessage(msg);
        setTimeout(() => setToastMessage(null), 2500);
    };

    const handleAddToCart = (product) => {
        setCartItems((prev) => {
            const existing = prev.find((item) => item.id === product.id);
            if (existing) {
                return prev.map((item) =>
                    item.id === product.id ? { ...item, quantity: item.quantity + 1 } : item
                );
            } else {
                return [...prev, { ...product, quantity: 1 }];
            }
        });
        showToast(`"${product.title.slice(0, 24)}..." কার্টে যোগ হয়েছে!`);
    };

    const handleUpdateQuantity = (id, newQty) => {
        setCartItems((prev) =>
            prev.map((item) => (item.id === id ? { ...item, quantity: newQty } : item))
        );
    };

    const handleRemoveItem = (id) => {
        setCartItems((prev) => prev.filter((item) => item.id !== id));
        showToast('পণ্যটি ব্যাগ থেকে বাদ দেওয়া হয়েছে');
    };

    const handleClearCart = () => {
        setCartItems([]);
    };

    const totalCartCount = cartItems.reduce((acc, it) => acc + it.quantity, 0);

    return (
        <div className="min-h-screen bg-[#F8FAFC] text-slate-900 font-sans flex flex-col selection:bg-[#F85606] selection:text-white">
            {/* Live Toast Notification */}
            {toastMessage && (
                <div className="fixed bottom-5 right-5 z-50 bg-slate-900 text-white px-4 py-2.5 rounded-2xl shadow-2xl border border-slate-700 text-xs font-bold flex items-center gap-2 animate-in fade-in slide-in-from-bottom-3">
                    <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping" />
                    <span>{toastMessage}</span>
                </div>
            )}

            {/* Sticky Navigation Bar with Daraz Sub-Header */}
            <MarketplaceNavbar
                topBarData={data.top_bar}
                cartCount={totalCartCount}
                onOpenCart={() => setCartOpen(true)}
                searchQuery={searchQuery}
                setSearchQuery={setSearchQuery}
                selectedCategory={selectedCategory}
                setSelectedCategory={setSelectedCategory}
                categories={data.categories || []}
                trendingKeywords={data.trending_keywords || []}
            />

            {/* Main Content Sections */}
            <main id="main-content" className="flex-1">
                {/* 1. Hero Deals Carousel with Desktop Categories Sidebar & Quick Actions */}
                <PromoBanners
                    banners={data.hero_banners || []}
                    stats={data.platform?.stats || []}
                    categories={data.categories || []}
                    onSelectCategory={setSelectedCategory}
                />

                {/* 2. Customer Trust Guarantees Strip (Daraz Guarantees) */}
                <TrustGuarantees
                    guarantees={data.trust_guarantees || []}
                />

                {/* 3. Category Rounded Pills */}
                <CategoryPills
                    categories={data.categories || []}
                    selectedCategory={selectedCategory}
                    onSelectCategory={setSelectedCategory}
                />

                {/* 4. Flash Deals with Live Countdown Clock */}
                <FlashDeals
                    flashSaleData={data.flash_sale}
                    onAddToCart={handleAddToCart}
                />

                {/* 5. Daraz Mall / Official Store Brands Showcase */}
                <OfficialStores
                    stores={data.official_stores || []}
                />

                {/* 6. Multi-Vendor Just For You Product Feed */}
                <ProductFeed
                    products={data.recommended_feed || []}
                    onAddToCart={handleAddToCart}
                    selectedCategory={selectedCategory}
                    searchQuery={searchQuery}
                />

                {/* 7. Daraz Comparison & Merchant Onboarding Section */}
                <div id="daraz-comparison">
                    <DarazComparisonTable
                        comparisonData={data.daraz_comparison}
                        sellerCardData={data.seller_cta_card}
                    />
                </div>
            </main>

            {/* Cart Slide-Over Drawer */}
            <CartDrawer
                isOpen={cartOpen}
                onClose={() => setCartOpen(false)}
                cartItems={cartItems}
                onUpdateQuantity={handleUpdateQuantity}
                onRemoveItem={handleRemoveItem}
                onClearCart={handleClearCart}
            />

            {/* Responsive Marketplace Footer */}
            <MarketplaceFooter />
        </div>
    );
}
