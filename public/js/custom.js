document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('blogSearch');
    const searchDropdown = document.getElementById('searchDropdown');
  
    searchInput.addEventListener('input', async (e) => {
      const query = e.target.value.trim();
  
      if (query.length < 2) {
        searchDropdown.style.display = 'none';
        return;
      }
  
      try {
        // Fetch search results via AJAX
        const response = await fetch(`${BASE_DIR}/search?query=${encodeURIComponent(query)}`);
        const results = await response.json();
  
        // Clear previous results
        searchDropdown.innerHTML = '';
  
        if (results.length > 0) {
          results.forEach((post) => {
            const item = document.createElement('a');
            item.href = `${BASE_DIR}/post/${post.id}`;
            item.className = 'dropdown-item d-flex align-items-center';
            item.innerHTML = `
              <img src="${BASE_DIR}/public/uploads/${post.image_path}" alt="${post.title}" class="img-thumbnail mr-2" style="width: 50px; height: 50px; object-fit: cover;">
              <span>${post.title}</span>
            `;
            searchDropdown.appendChild(item);
          });
  
          searchDropdown.style.display = 'block';
        } else {
          searchDropdown.innerHTML = `<span class="dropdown-item">No results found</span>`;
          searchDropdown.style.display = 'block';
        }
      } catch (error) {
        console.error('Error fetching search results:', error);
      }
    });
  
    // Hide dropdown on outside click
    document.addEventListener('click', (e) => {
      if (!searchDropdown.contains(e.target) && e.target !== searchInput) {
        searchDropdown.style.display = 'none';
      }
    });
  });
  
  document.getElementById('submitComment').addEventListener('click', function () {
    const postId = document.getElementById('commentForm').getAttribute('data-post-id');
    const csrfToken = document.getElementById('csrfToken').value;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const comment = document.getElementById('comment').value;

    if (!name || !email || !comment) {
        alert('Please fill in all fields.');
        return;
    }

    fetch(`${BASE_DIR}/comments/create/${postId}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, email, comment, csrfToken }),
    })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                showToast('success', 'Comment submitted successfully!');
                document.getElementById('name').value = '';
                document.getElementById('email').value = '';
                document.getElementById('comment').value = '';
             } else {
                showToast('error', 'Failed to submit the comment: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'An error occurred while submitting your comment.');
        });
});
function showToast(type, message) {
  const toast = document.querySelector(".toast");
  const toastContent = document.querySelector(".toast-content");
  const progress = document.querySelector(".progress");
  const closeIcon = document.querySelector(".close");
  const checkIcon = document.querySelector(".check");

  // Reset previous state
  toastContent.classList.remove("success", "error");
  toast.classList.remove("active");
  progress.classList.remove("active");

  // Update toast message and styling
  if (type === 'success') {
      toastContent.classList.add("success");
      checkIcon.classList.remove("fa-triangle-exclamation");
      checkIcon.classList.add("fa-check");
  } else {
      toastContent.classList.add("error");
      checkIcon.classList.remove("fa-check");
      checkIcon.classList.add("fa-triangle-exclamation");
  }
   toast.querySelector('.text-2').textContent = message;

  // Show toast
  toast.classList.add("active");
  progress.classList.add("active");

  // Auto-hide the toast after 5 seconds
  const timer1 = setTimeout(() => {
      toast.classList.remove("active");
      progress.classList.remove("active");
  }, 5000);

  // Close toast on click of close icon
  closeIcon.addEventListener("click", () => {
      toast.classList.remove("active");
      progress.classList.remove("active");
      clearTimeout(timer1);
  });
}

