import React, { useState } from 'react';
import AtelierNavbar from './components/AtelierNavbar';
import LookbookHero from './components/LookbookHero';
import ClothingCollectionGrid from './components/ClothingCollectionGrid';
import QuickViewModal from './components/QuickViewModal';
import SlideOverBagDrawer from './components/SlideOverBagDrawer';
import AtelierPillars from './components/AtelierPillars';
import AtelierFooter from './components/AtelierFooter';

export default function ShopLandingApp({ initialData }) {
    const data = initialData || {};

    const [bagItems, setBagItems] = useState([
        // Initial sample item for testing
        {
            id: 'za-01',
            title: 'Boxy Heavyweight Tee (Pitch Black)',
            selectedSize: 'XL',
            price: 1150,
            quantity: 1,
            gsm: '240 GSM',
            image_front: 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=700&auto=format&fit=crop&q=80'
        }
    ]);
    const [bagOpen, setBagOpen] = useState(false);
    const [selectedCollection, setSelectedCollection] = useState('all');
    const [quickViewProduct, setQuickViewProduct] = useState(null);
    const [toastMessage, setToastMessage] = useState(null);

    const showToast = (msg) => {
        setToastMessage(msg);
        setTimeout(() => setToastMessage(null), 2500);
    };

    const handleAddToCart = (product, size) => {
        setBagItems((prev) => {
            const existing = prev.find((item) => item.id === product.id && item.selectedSize === size);
            if (existing) {
                return prev.map((item) =>
                    item.id === product.id && item.selectedSize === size
                        ? { ...item, quantity: item.quantity + 1 }
                        : item
                );
            } else {
                return [...prev, { ...product, selectedSize: size, quantity: 1 }];
            }
        });
        showToast(`"${product.title}" (${size}) ব্যাগে যোগ হয়েছে!`);
    };

    const handleUpdateQuantity = (productId, size, newQty) => {
        setBagItems((prev) =>
            prev.map((item) =>
                item.id === productId && item.selectedSize === size ? { ...item, quantity: newQty } : item
            )
        );
    };

    const handleRemoveItem = (productId, size) => {
        setBagItems((prev) =>
            prev.filter((item) => !(item.id === productId && item.selectedSize === size))
        );
        showToast('পোশাকটি ব্যাগ থেকে সরানো হয়েছে');
    };

    const handleClearBag = () => {
        setBagItems([]);
    };

    const totalBagCount = bagItems.reduce((acc, it) => acc + it.quantity, 0);

    return (
        <div className="min-h-screen bg-[#FAFAFA] text-slate-900 font-sans flex flex-col selection:bg-slate-900 selection:text-white">
            {/* Live Toast Notification */}
            {toastMessage && (
                <div className="fixed bottom-5 right-5 z-50 bg-slate-950 text-white px-4 py-2.5 rounded-2xl shadow-2xl border border-slate-800 text-xs font-bold flex items-center gap-2 animate-in fade-in slide-in-from-bottom-3">
                    <span className="w-2 h-2 rounded-full bg-emerald-400 animate-ping" />
                    <span>{toastMessage}</span>
                </div>
            )}

            {/* Atelier Luxury Navbar */}
            <AtelierNavbar
                brandData={data.brand}
                bagCount={totalBagCount}
                onOpenBag={() => setBagOpen(true)}
                selectedCollection={selectedCollection}
                onSelectCollection={setSelectedCollection}
                collections={data.collections || []}
            />

            {/* Main Storefront Feed */}
            <main id="main-content" className="flex-1">
                {/* Lookbook Hero Banner */}
                <LookbookHero
                    heroData={data.lookbook_hero}
                    onOpenSizeGuide={() => setQuickViewProduct(data.products?.[0] || null)}
                />

                {/* Clothing Collections Grid */}
                <ClothingCollectionGrid
                    products={data.products || []}
                    selectedCollection={selectedCollection}
                    onSelectCollection={setSelectedCollection}
                    collections={data.collections || []}
                    onAddToCart={handleAddToCart}
                    onQuickView={(prod) => setQuickViewProduct(prod)}
                    onOpenSizeGuide={() => setQuickViewProduct(data.products?.[0] || null)}
                />

                {/* Craftsmanship Pillars */}
                <AtelierPillars pillars={data.craftsmanship_pillars || []} />
            </main>

            {/* Quick View & Size Guide Modal */}
            <QuickViewModal
                product={quickViewProduct}
                onClose={() => setQuickViewProduct(null)}
                onAddToCart={handleAddToCart}
                sizeGuideData={data.size_guide}
            />

            {/* Slide-Over Shopping Bag Drawer */}
            <SlideOverBagDrawer
                isOpen={bagOpen}
                onClose={() => setBagOpen(false)}
                bagItems={bagItems}
                onUpdateQuantity={handleUpdateQuantity}
                onRemoveItem={handleRemoveItem}
                onClearBag={handleClearBag}
            />

            {/* Atelier Responsive Footer */}
            <AtelierFooter brandData={data.brand} />
        </div>
    );
}
