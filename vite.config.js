import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/index.jsx',
                'resources/assets/admin/css/bootstrap.min.css',
                'resources/assets/admin/css/dashboard.css',
                'resources/assets/admin/js/bootstrap.bundle.min.js',
                'resources/assets/emails/css/email.css',
            ],
            refresh: true,
        }),

    ],
});
