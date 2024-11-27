document.addEventListener('DOMContentLoaded', () => {
    const themeSwitchers = document.querySelectorAll('#theme-switcher');
    
    // Function to update icons visibility for all switchers
    function updateIcons(theme) {
        document.querySelectorAll('.icon-sun').forEach(sunIcon => {
            sunIcon.classList.toggle('d-none', theme === 'dark');
        });
        document.querySelectorAll('.icon-moon').forEach(moonIcon => {
            moonIcon.classList.toggle('d-none', theme === 'light');
        });
    }

    // Function to set theme
    function setTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
        updateIcons(theme);
    }

    // Initialize theme
    const savedTheme = localStorage.getItem('theme') || 
                      (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    setTheme(savedTheme);

    // Add click event to all theme switchers
    themeSwitchers.forEach(switcher => {
        switcher.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            setTheme(newTheme);
        });
    });
}); 