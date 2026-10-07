import './bootstrap';
import './echo';
import './react/index.jsx';

// Preloader Logic
(function () {
    const preloader = document.getElementById('preloader');
    if (!preloader) return;

    // If already hidden by inline script (cached version), don't run animation logic
    if (getComputedStyle(preloader).display === 'none' || preloader.classList.contains('hidden')) {
        return;
    }

    const progressCircle = document.getElementById('progress-circle');
    const percentageText = document.getElementById('loader-percentage');
    const circumference = 2 * Math.PI * 70; // r=70
    const version = 'v1.2';

    let currentProgress = 0;
    const updateLoader = (pct) => {
        const offset = circumference - (pct / 100) * circumference;
        if (progressCircle) progressCircle.style.strokeDashoffset = offset;
        if (percentageText) percentageText.textContent = Math.round(pct) + '%';
    };

    const interval = setInterval(() => {
        if (currentProgress < 95) {
            currentProgress += Math.random() * 5;
            if (currentProgress > 95) currentProgress = 95;
            updateLoader(currentProgress);
        }
    }, 100);

    window.addEventListener('load', () => {
        clearInterval(interval);
        updateLoader(100);
        setTimeout(() => {
            preloader.classList.add('hidden');
            document.body.style.overflow = 'auto';
            // Save version to localStorage after first successful load
            localStorage.setItem('zengfy_preloader_version', version);
        }, 600);
    });

    document.body.style.overflow = 'hidden';
})();

// Cookies Banner Logic
window.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('cookie-banner');
    if (banner && !localStorage.getItem('cookies-accepted')) {
        setTimeout(() => {
            banner.classList.remove('translate-y-20', 'opacity-0');
        }, 2000);
    }
});

window.acceptCookies = function() {
    localStorage.setItem('cookies-accepted', 'true');
    const lsCount = localStorage.length;
    const cookieCount = document.cookie ? document.cookie.split(';').length : 0;
    const lsKeys = Object.keys(localStorage).slice(0, 5).join(', ') + (lsCount > 5 ? '...' : '');

    let totalBytes = 0;
    for (let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        totalBytes += key.length + localStorage.getItem(key).length;
    }
    totalBytes += document.cookie.length;
    const memoryMB = (totalBytes / 1024 + 0.42).toFixed(2);

    const lsCountEl = document.getElementById('local-storage-count');
    const cookieCountEl = document.getElementById('cookie-count');
    const memorySavedEl = document.getElementById('memory-saved');
    const storageDetailsEl = document.getElementById('storage-details');
    const cookieMainContent = document.getElementById('cookie-main-content');
    const cookieDataInfo = document.getElementById('cookie-data-info');

    if (lsCountEl) lsCountEl.textContent = lsCount;
    if (cookieCountEl) cookieCountEl.textContent = cookieCount;
    if (memorySavedEl) memorySavedEl.textContent = memoryMB + ' KB';
    if (storageDetailsEl) storageDetailsEl.textContent = 'Keys: ' + (lsKeys || 'None');
    if (cookieMainContent) cookieMainContent.classList.add('hidden');
    if (cookieDataInfo) cookieDataInfo.classList.remove('hidden');
};

window.closeCookies = function() {
    const banner = document.getElementById('cookie-banner');
    if (banner) banner.classList.add('translate-y-20', 'opacity-0');
};

// Service Worker Registration
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').then((registration) => {
            registration.onupdatefound = () => {
                const installingWorker = registration.installing;
                installingWorker.onstatechange = () => {
                    if (installingWorker.state === 'installed' && navigator.serviceWorker.controller) {
                        console.log('New content available; please refresh.');
                    }
                };
            };
        }).catch((error) => console.log('SW registration failed:', error));
    });
}
