import React from 'react';
import { createRoot } from 'react-dom/client';
import EcommerceMarketplaceApp from './EcommerceMarketplaceApp';

const container = document.getElementById('react-ecommerce-marketplace-root');

if (container) {
    let initialData = null;
    try {
        const raw = container.getAttribute('data-initial-data');
        if (raw) {
            initialData = JSON.parse(raw);
        }
    } catch (e) {
        console.error('Failed to parse initial marketplace data:', e);
    }

    const root = createRoot(container);
    root.render(
        <React.StrictMode>
            <EcommerceMarketplaceApp initialData={initialData} />
        </React.StrictMode>
    );
}
