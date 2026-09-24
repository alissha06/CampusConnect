// CampusConnect - Main JS
console.log("CampusConnect script loaded");

// Dropdown menu toggle
document.addEventListener('DOMContentLoaded', function () {
  const dropdown = document.querySelector('.dropdown');
  const toggle = document.querySelector('.dropdown-toggle');

  if (toggle) {
    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      dropdown.classList.toggle('open');
    });

    document.addEventListener('click', function () {
      dropdown.classList.remove('open');
    });
  }
});

// Admission Checklist - Mark as Completed
function markCompleted(button) {
  const item = button.closest('.checklist-item');
  item.classList.remove('pending');
  item.classList.add('completed');

  // Update icon
  item.querySelector('.checklist-icon').textContent = '✓';

  // Update status tag
  const statusTag = item.querySelector('.status-tag');
  statusTag.textContent = 'Completed';
  statusTag.classList.remove('pending-tag');
  statusTag.classList.add('done');

  // Remove the action buttons
  item.querySelector('.checklist-actions').remove();

  // Update the progress bar
  updateProgress();
}

function updateProgress() {
  const totalItems = document.querySelectorAll('.checklist-item').length;
  const completedItems = document.querySelectorAll('.checklist-item.completed').length;
  const percent = Math.round((completedItems / totalItems) * 100);

  document.getElementById('progress-bar-fill').style.width = percent + '%';
  document.getElementById('progress-number').textContent = percent;
  document.getElementById('progress-caption').textContent = completedItems + ' of ' + totalItems + ' requirements completed';
}

// Notices - Search & Filter
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('notice-search');
  const filterPills = document.querySelectorAll('.filter-pill');
  const noticeCards = document.querySelectorAll('.notice-card');
  const resultsCount = document.getElementById('results-count');
  const noResults = document.getElementById('no-results');

  if (!searchInput) return; // only run this on the Notices page

  let activeFilter = 'all';

  function applyFilters() {
    const query = searchInput.value.toLowerCase().trim();
    let visibleCount = 0;

    noticeCards.forEach(function (card) {
      const matchesCategory = activeFilter === 'all' || card.dataset.category === activeFilter;
      const matchesSearch = card.dataset.title.includes(query);

      if (matchesCategory && matchesSearch) {
        card.style.display = '';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    resultsCount.textContent = visibleCount;
    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
  }

  searchInput.addEventListener('input', applyFilters);

  filterPills.forEach(function (pill) {
    pill.addEventListener('click', function () {
      filterPills.forEach(function (p) { p.classList.remove('active'); });
      pill.classList.add('active');
      activeFilter = pill.dataset.filter;
      applyFilters();
    });
  });
});

// Events - Search Filter
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('event-search');
  const eventCards = document.querySelectorAll('.event-card');
  const resultsCount = document.getElementById('results-count');
  const noResults = document.getElementById('no-results');

  if (searchInput) {
    searchInput.addEventListener('input', function () {
      const query = searchInput.value.toLowerCase().trim();
      let visibleCount = 0;

      eventCards.forEach(function (card) {
        if (card.dataset.title.includes(query)) {
          card.style.display = '';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      resultsCount.textContent = visibleCount;
      noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    });
  }
});

// Event Registration - Confirmation Toast
// Event Registration Modal
let currentEventName = '';

function openRegisterModal(eventName) {
  currentEventName = eventName;
  document.getElementById('modal-event-name').textContent = eventName;
  document.getElementById('register-modal').classList.add('show');
  document.getElementById('register-form').reset();
}

function closeRegisterModal() {
  document.getElementById('register-modal').classList.remove('show');
}

function submitRegistration(e) {
  e.preventDefault();
  const name = document.getElementById('reg-name').value;
  closeRegisterModal();

  const toast = document.getElementById('register-toast');
  toast.textContent = '✓ Thanks ' + name + '! You\'re registered for "' + currentEventName + '"';
  toast.classList.add('show');
  setTimeout(function () {
    toast.classList.remove('show');
  }, 4000);
}

document.addEventListener('click', function (e) {
  const overlay = document.getElementById('register-modal');
  if (overlay && e.target === overlay) {
    closeRegisterModal();
  }
});

// Events - Search Filter
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('event-search');
  const eventCards = document.querySelectorAll('.event-card');
  const resultsCount = document.getElementById('results-count');
  const noResults = document.getElementById('no-results');

  if (searchInput) {
    searchInput.addEventListener('input', function () {
      const query = searchInput.value.toLowerCase().trim();
      let visibleCount = 0;
      eventCards.forEach(function (card) {
        if (card.dataset.title.includes(query)) {
          card.style.display = '';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });
      resultsCount.textContent = visibleCount;
      noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    });
  }
});