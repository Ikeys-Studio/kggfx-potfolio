AOS.init({
  duration: 1000, // animation duration in ms
  once: true      // only animate once when scrolling down
});
// Js/main.js
AOS.init({
  duration: 800,
  once: true
});
window.addEventListener('scroll', () => {
  const header = document.getElementById('main-header');
  if (window.scrollY > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});
// Get modal elements
const modal = document.getElementById("projectModal");
const modalTitle = document.getElementById("modal-title");
const modalDescription = document.getElementById("modal-description");
const modalClose = document.querySelector(".modal .close");

// Open modal with content
function openModal(title, description) {
  modalTitle.textContent = title;
  modalDescription.textContent = description;
  modal.style.display = "flex";
}

// Close modal
modalClose.addEventListener("click", () => {
  modal.style.display = "none";
});

// Close when clicking outside
window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});
document.addEventListener("DOMContentLoaded", function () {
  const text = "Creative solutions for a digital world.";
  const typingElement = document.getElementById("typed-text");

  let index = 0;
  let direction = 1;

  function type() {
    typingElement.textContent = text.substring(0, index);

    if (direction === 1) {
      if (index < text.length) {
        index++;
      } else {
        direction = -1;
        setTimeout(type, 1500); // wait before erasing
        return;
      }
    } else {
      if (index > 0) {
        index--;
      } else {
        direction = 1;
        setTimeout(type, 800); // wait before typing again
        return;
      }
    }

    setTimeout(type, 80);
  }

  type();
});
