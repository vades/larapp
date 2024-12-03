/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            textColor: {
                skin: {
                    'brand-primary': 'var(--color-brand-primary)',
                    'brand-secondary': 'var(--color-brand-secondary)',
                    'base': 'var(--color-text-base)',
                    'muted': 'var(--color-text-muted)',
                    'inverted': 'var(--color-text-inverted)',
                    'accent': 'var(--color-text-accent)',
                    'heading': 'var(--color-text-heading)',
                    'link': 'var(--color-text-link)',
                    'link-hover': 'var(--color-text-link-hover)',
                    'header': 'var(--color-text-header)',
                    'header-muted': 'var(--color-text-header-muted)',
                    'footer': 'var(--color-text-footer)',
                    'footer-muted': 'var(--color-text-footer-muted)',
                    'info': 'var(--color-text-info)',
                    'success': 'var(--color-text-success)',
                    'warning': 'var(--color-text-warning)',
                    'danger': 'var(--color-text-danger)',
                },
            },
            backgroundColor: {
                skin: {
                    'base': 'var(--color-bg-base)',
                    'accent': 'var(--color-bg-accent)',
                    'header': 'var(--color-bg-header)',
                    'footer': 'var(--color-bg-footer)',
                    'info': 'var(--color-bg-info)',
                    'success': 'var(--color-bg-success)',
                    'warning': 'var( --color-bg-warning)',
                    'danger': 'var(--color-bg-danger)',

                },
            },
            borderColor: {
                skin: {
                    'base': 'var(--color-border-base)',
                    'muted': 'var(--color-border-muted)',
                    'footer': 'var(--color-border-footer)',
                    'info': 'var(--color-border-info)',
                    'success': 'var(--color-border-success)',
                    'warning': 'var(--color-border-warning)',
                    'danger': 'var(--color-border-danger)',
                },
            },
            fill: {
                skin: {
                    'brand-primary': 'var(--color-brand-primary)',
                    'brand-secondary': 'var(--color-brand-secondary)',
                    'icon': 'var(--color-fill-icon)',
                },
            },
        },
    },
    darkMode: 'class',
    plugins: [],
}

