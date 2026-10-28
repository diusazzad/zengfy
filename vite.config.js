import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        cors: true,
        hmr: {
            host: 'localhost',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/react/main.jsx',
                'Modules/Landing/resources/js/main.jsx',
                'Modules/Social/resources/js/main.jsx',
                'Modules/School/resources/js/main.jsx',
                'Modules/POS/resources/js/main.jsx',
                'Modules/Law/resources/js/main.jsx',
                'Modules/Civil/resources/js/main.jsx',
                'Modules/NGO/resources/js/main.jsx',
                'Modules/Rent/resources/js/main.jsx',
                'Modules/Hotel/resources/js/main.jsx',
                'Modules/Shop/resources/js/main.jsx',
                'Modules/Ecommerce/resources/js/main.jsx',
                'Modules/Skill/resources/js/main.jsx',
                'Modules/Journal/resources/js/main.jsx',
                'Modules/Habit/resources/js/main.jsx',
                'Modules/Schedule/resources/js/main.jsx',
            ],
            refresh: true,
        }),
        tailwindcss(),
        react(),
    ],
});
