import './bootstrap';
import './echo';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

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
    const banner = document.getElementById('cookie-banner');
    if (banner) {
        banner.classList.add('translate-y-20', 'opacity-0');
        setTimeout(() => banner.remove(), 300);
    }
};
