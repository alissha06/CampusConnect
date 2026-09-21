// Dropdown menu toggle
document.addEventListener('DOMContentLoaded', function () {
  const dropdown = document.querySelector('.dropdown');
  const toggle = document.querySelector('.dropdown-toggle');

  if (toggle) {
    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      dropdown.classList.toggle('open');
    });

    // Close dropdown if clicking anywhere else
    document.addEventListener('click', function () {
      dropdown.classList.remove('open');
    });
  }
});