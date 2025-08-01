// dashboard.js
document.addEventListener('DOMContentLoaded', function () {
  console.log('Dashboard is ready!');

  // Optional: add click confirmations, UI tweaks, etc.
});
// Modal for Adding Project
function openAddModal() {
  const modal = document.getElementById('addModal');
  if (modal) {
    modal.style.display = 'block';
  }
}
function closeAddModal() {
  const modal = document.getElementById('addModal');
  if (modal) {
    modal.style.display = 'none';
  }
}


// Optional: Close modal when clicking outside of it
window.onclick = function(event) {
  const modal = document.getElementById('addModal');
  if (event.target === modal) {
    closeAddModal();
  }
};