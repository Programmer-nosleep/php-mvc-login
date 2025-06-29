document.addEventListener('DOMContentLoaded', () => {
  const toggleButton = document.getElementById('darkModeToggle');
  const body = document.body;

  if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('bg-dark', 'text-light');
    const navbar = document.getElementById('mainNavbar');
    navbar.classList.replace('navbar-light', 'navbar-dark');
    navbar.classList.replace('bg-white', 'bg-dark');
  }

  if (toggleButton) {
    toggleButton.addEventListener('click', () => {
      const isDark = body.classList.toggle('bg-dark');
      body.classList.toggle('text-light');
      const navbar = document.getElementById('mainNavbar');
      navbar.classList.toggle('navbar-dark');
      navbar.classList.toggle('navbar-light');
      navbar.classList.toggle('bg-dark');
      navbar.classList.toggle('bg-white');
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
  }
});