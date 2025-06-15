import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/main.css',
                'resources/css/members.css',
                'resources/js/app.js',
                'resources/js/echo.js',
                'resources/js/connect/LoginButton.js',
                'resources/js/channels/MenuMover.js',
                'resources/js/channels/ChatLoader.js',
                'resources/js/channels/MessageSender.js',
                'resources/js/channels/InvitationScripts.js',
                'resources/js/channels/BlockScript.js',
                "resources/js/channels/KickUser.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
