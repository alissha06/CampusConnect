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

// ===== Lost & Found: browse page (search, filter, details popup) =====
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('item-search');
  if (!searchInput) return;

  const pills = document.querySelectorAll('#item-filter-pills .filter-pill');
  const cards = document.querySelectorAll('.item-card');
  const resultsCount = document.getElementById('results-count');
  const noResults = document.getElementById('no-results');
  let activeFilter = 'all';

  function applyItemFilters() {
    const query = searchInput.value.toLowerCase().trim();
    let visible = 0;
    cards.forEach(function (card) {
      const matchesType = activeFilter === 'all' || card.dataset.type === activeFilter;
      const matchesSearch = card.dataset.search.includes(query);
      const show = matchesType && matchesSearch;
      card.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    resultsCount.textContent = visible;
    noResults.style.display = visible === 0 ? 'block' : 'none';
  }

  searchInput.addEventListener('input', applyItemFilters);
  pills.forEach(function (pill) {
    pill.addEventListener('click', function () {
      pills.forEach(function (p) { p.classList.remove('active'); });
      pill.classList.add('active');
      activeFilter = pill.dataset.filter;
      applyItemFilters();
    });
  });
});

function openItemModal(button) {
  const card = button.closest('.item-card');
  const tag = document.getElementById('item-modal-tag');
  tag.textContent = card.dataset.type === 'lost' ? 'Lost' : 'Found';
  tag.className = 'item-type-tag inline ' + card.dataset.type;
  document.getElementById('item-modal-title').textContent = card.dataset.name;
  document.getElementById('item-modal-desc').textContent = card.dataset.desc;
  document.getElementById('item-modal-location').textContent = card.dataset.location;
  document.getElementById('item-modal-date').textContent = card.dataset.date;
  document.getElementById('item-modal-contact').textContent = card.dataset.contact;
  document.getElementById('item-modal').classList.add('show');
}

function closeItemModal() {
  document.getElementById('item-modal').classList.remove('show');
}

document.addEventListener('click', function (e) {
  const modal = document.getElementById('item-modal');
  if (modal && e.target === modal) closeItemModal();
});

document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    const modal = document.getElementById('item-modal');
    if (modal) closeItemModal();
  }
});

// ===== Lost & Found: post form =====
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('post-item-form');
  if (!form) return;

  // Set to e.g. '@sicsr.ac.in' once you confirm the college email domain
  const ALLOWED_EMAIL_DOMAIN = '';
  const MAX_PHOTO_MB = 5;

  const typeInput = document.getElementById('item-type');
  const typeButtons = document.querySelectorAll('.type-option');
  const locationLabel = document.getElementById('location-label');
  const dateLabel = document.getElementById('date-label');
  const dateInput = document.getElementById('item-date');
  const descInput = document.getElementById('item-desc');
  const charCount = document.getElementById('char-count');
  const photoInput = document.getElementById('item-photo');
  const zone = document.getElementById('upload-zone');
  const preview = document.getElementById('upload-preview');
  const previewImg = document.getElementById('preview-img');
  const successBox = document.getElementById('form-success');

  // Dates cannot be in the future
  dateInput.max = new Date().toISOString().split('T')[0];

  // Lost / Found toggle
  typeButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      typeButtons.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      typeInput.value = btn.dataset.type;
      const word = btn.dataset.type === 'lost' ? 'lost' : 'found';
      locationLabel.textContent = 'Location ' + word;
      dateLabel.textContent = 'Date ' + word;
    });
  });

  // Character counter
  descInput.addEventListener('input', function () {
    charCount.textContent = descInput.value.length;
  });

  // Photo preview
  function showPhoto(file) {
    setError('err-photo', '');
    if (!file) { clearPhoto(); return; }
    const okTypes = ['image/png', 'image/jpeg', 'image/webp'];
    if (okTypes.indexOf(file.type) === -1) {
      setError('err-photo', 'Please choose a PNG, JPG or WEBP image.');
      clearPhoto();
      return;
    }
    if (file.size > MAX_PHOTO_MB * 1024 * 1024) {
      setError('err-photo', 'Photo must be under ' + MAX_PHOTO_MB + ' MB.');
      clearPhoto();
      return;
    }
    const reader = new FileReader();
    reader.onload = function (e) {
      previewImg.src = e.target.result;
      preview.style.display = 'block';
    };
    reader.readAsDataURL(file);
  }

  function clearPhoto() {
    photoInput.value = '';
    previewImg.src = '';
    preview.style.display = 'none';
  }

  photoInput.addEventListener('change', function () { showPhoto(photoInput.files[0]); });
  document.getElementById('remove-photo').addEventListener('click', clearPhoto);

  // Drag and drop
  ['dragenter', 'dragover'].forEach(function (evt) {
    zone.addEventListener(evt, function (e) { e.preventDefault(); zone.classList.add('dragging'); });
  });
  ['dragleave', 'drop'].forEach(function (evt) {
    zone.addEventListener(evt, function (e) { e.preventDefault(); zone.classList.remove('dragging'); });
  });
  zone.addEventListener('drop', function (e) {
    if (e.dataTransfer.files.length) {
      photoInput.files = e.dataTransfer.files;
      showPhoto(photoInput.files[0]);
    }
  });

  // Validation helpers
  function setError(id, message) {
    document.getElementById(id).textContent = message;
  }

  function validate() {
    let ok = true;
    const name = document.getElementById('item-name').value.trim();
    const category = document.getElementById('item-category').value;
    const desc = descInput.value.trim();
    const location = document.getElementById('item-location').value.trim();
    const date = dateInput.value;
    const email = document.getElementById('item-email').value.trim();

    setError('err-name', name ? '' : 'Please enter the item name.');
    setError('err-category', category ? '' : 'Please select a category.');
    setError('err-desc', desc.length >= 10 ? '' : 'Please add a short description (at least 10 characters).');
    setError('err-location', location ? '' : 'Please enter a location.');
    setError('err-date', date ? '' : 'Please choose a date.');

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let emailMessage = '';
    if (!emailPattern.test(email)) {
      emailMessage = 'Please enter a valid email address.';
    } else if (ALLOWED_EMAIL_DOMAIN && !email.toLowerCase().endsWith(ALLOWED_EMAIL_DOMAIN)) {
      emailMessage = 'Please use your college email (' + ALLOWED_EMAIL_DOMAIN + ').';
    }
    setError('err-email', emailMessage);

    if (!name || !category || desc.length < 10 || !location || !date || emailMessage) ok = false;
    return ok;
  }

  // Submit (frontend only for now)
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    successBox.style.display = 'none';
    if (!validate()) return;

    form.reset();
    clearPhoto();
    charCount.textContent = '0';
    typeButtons.forEach(function (b) { b.classList.remove('active'); });
    typeButtons[0].classList.add('active');
    typeInput.value = 'lost';
    locationLabel.textContent = 'Location lost';
    dateLabel.textContent = 'Date lost';

    successBox.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // Clear form button
  form.addEventListener('reset', function () {
    clearPhoto();
    charCount.textContent = '0';
    document.querySelectorAll('.field-error').forEach(function (el) { el.textContent = ''; });
  });
});

// ===== Feedback form =====
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('feedback-form');
  if (!form) return;

  const stars = document.querySelectorAll('.star-btn');
  const ratingInput = document.getElementById('fb-rating');
  const ratingLabel = document.getElementById('rating-label');
  const message = document.getElementById('fb-message');
  const counter = document.getElementById('fb-char-count');
  const successBox = document.getElementById('fb-success');
  const labels = ['Select a rating', 'Poor', 'Fair', 'Good', 'Very good', 'Excellent'];

  function setError(id, text) {
    document.getElementById(id).textContent = text;
  }

  function currentRating() {
    return parseInt(ratingInput.value, 10) || 0;
  }

  function paint(count) {
    stars.forEach(function (star, i) {
      star.classList.toggle('filled', i < count);
    });
  }

  function setRating(count) {
    ratingInput.value = count || '';
    paint(count);
    ratingLabel.textContent = labels[count];
    ratingLabel.classList.toggle('chosen', count > 0);
  }

  // Star rating: click to choose, hover to preview
  stars.forEach(function (star, i) {
    star.addEventListener('click', function () {
      setRating(i + 1);
      setError('fb-err-rating', '');
    });
    star.addEventListener('mouseenter', function () { paint(i + 1); });
    star.addEventListener('mouseleave', function () { paint(currentRating()); });
  });

  // Character counter
  message.addEventListener('input', function () {
    counter.textContent = message.value.length;
  });

  // Validation
  function validate() {
    const name = document.getElementById('fb-name').value.trim();
    const email = document.getElementById('fb-email').value.trim();
    const category = document.getElementById('fb-category').value;
    const text = message.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const nameError = name ? '' : 'Please enter your name.';
    const emailError = emailPattern.test(email) ? '' : 'Please enter a valid email address.';
    const categoryError = category ? '' : 'Please select a category.';
    const ratingError = currentRating() > 0 ? '' : 'Please choose a rating.';
    const messageError = text.length >= 10 ? '' : 'Please write at least 10 characters.';

    setError('fb-err-name', nameError);
    setError('fb-err-email', emailError);
    setError('fb-err-category', categoryError);
    setError('fb-err-rating', ratingError);
    setError('fb-err-message', messageError);

    return !(nameError || emailError || categoryError || ratingError || messageError);
  }

  // Submit (frontend only for now)
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    successBox.style.display = 'none';
    if (!validate()) return;

    form.reset();
    successBox.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // Clear form (also runs after a successful submit)
  form.addEventListener('reset', function () {
    setRating(0);
    counter.textContent = '0';
    document.querySelectorAll('#feedback-form .field-error').forEach(function (el) {
      el.textContent = '';
    });
  });
});