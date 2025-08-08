<script>
    const defaultThemeMode = 'system'; // light|dark|system
    let themeMode;

    if (document.documentElement) {
        if (localStorage.getItem('kt-theme')) {
            themeMode = localStorage.getItem('kt-theme');
        } else if (
            document.documentElement.hasAttribute('data-kt-theme-mode')
        ) {
            themeMode =
                document.documentElement.getAttribute('data-kt-theme-mode');
        } else {
            themeMode = defaultThemeMode;
        }

        if (themeMode === 'system') {
            themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ?
                'dark' :
                'light';
        }

        if (!localStorage.getItem('kt-theme')) {
            localStorage.setItem('kt-theme', themeMode);
        }
        document.documentElement.classList.add(themeMode);
    }
</script>
