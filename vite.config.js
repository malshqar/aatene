import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 'resources/js/app.js'],
//             refresh: true,
//         }),
//     ],
// });

export default function getConfig() {

    return defineConfig({
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                    'Modules/Shared/Resources/assets/css/app.css',
                    'Modules/Shared/Resources/assets/js/app.js',
                    'Modules/Store/Resources/assets/css/app.css',
                    'Modules/Store/Resources/assets/js/app.js',
                    'Modules/Store/Resources/assets/js/delete.js',
                ],
                refresh: true,
            })
        ]
    });
}
