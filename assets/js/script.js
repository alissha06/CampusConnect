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