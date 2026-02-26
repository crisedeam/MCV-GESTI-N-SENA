document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme) {
        document.body.classList.add(currentTheme);
        if (currentTheme === 'dark-theme' && themeToggleBtn) {
            themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i> Claro';
        }
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            document.body.classList.toggle('dark-theme');
            // Ensure light-theme is removed if it was present
            document.body.classList.remove('light-theme');

            let theme = 'light-theme';

            if (document.body.classList.contains('dark-theme')) {
                theme = 'dark-theme';
                themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i> Claro';
            } else {
                themeToggleBtn.innerHTML = '<i class="fa-solid fa-moon"></i> Oscuro';
                document.body.classList.add('light-theme');
            }

            localStorage.setItem('theme', theme);
        });
    }
});
