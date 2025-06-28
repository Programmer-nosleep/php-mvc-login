const toggleButton = document.getElementById('darkModeToggle');
const body = document.body;

// Apply saved mode on load

if (localStorage.getItem('theme') === 'dark') {
  body.classList.add('bg-dark', 'text-light');
  document.getElementById('mainNavbar').classList.replace('navbar-light', 'navbar-dark');
  document.getElementById('mainNavbar').classList.replace('bg-white', 'bg-dark');
}

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
