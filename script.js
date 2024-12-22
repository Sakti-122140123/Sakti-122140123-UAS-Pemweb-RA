// Form validation
function validateForm() {
  // Validasi Nama
  const nama = document.getElementById("nama").value;
  if (nama.length < 3) {
    showAlert("Nama harus minimal 3 karakter!", "error");
    return false;
  }

  // Validasi Umur
  const umur = document.getElementById("umur").value;
  if (umur < 5 || umur > 60) {
    showAlert("Umur harus antara 5-60 tahun!", "error");
    return false;
  }

  // Validasi Nomor Telepon
  const nomorTelepon = document.getElementById("nomor_telepon").value;
  if (!/^[0-9]{10,13}$/.test(nomorTelepon)) {
    showAlert("Nomor telepon harus 10-13 digit angka!", "error");
    return false;
  }

  // Validasi Pilihan Lomba
  const pilihanLomba = document.getElementById("pilihan_lomba").value;
  if (!pilihanLomba) {
    showAlert("Silakan pilih lomba yang akan diikuti!", "error");
    return false;
  }

  // Simpan data ke localStorage
  localStorage.setItem(
    "lastRegistration",
    JSON.stringify({
      nama: nama,
      umur: umur,
      lomba: pilihanLomba,
      timestamp: new Date().toISOString(),
    })
  );

  return true;
}

// Show alert function
function showAlert(message, type = "success") {
  const alertDiv = document.createElement("div");
  alertDiv.className = `alert ${type}`;
  alertDiv.textContent = message;

  const main = document.querySelector("main");
  main.insertBefore(alertDiv, main.firstChild);

  setTimeout(() => {
    alertDiv.remove();
  }, 3000);
}

// Save form data to sessionStorage
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("registrationForm");
  if (form) {
    // Restore form data from sessionStorage
    const inputs = form.getElementsByTagName("input");
    for (let input of inputs) {
      input.addEventListener("change", function () {
        sessionStorage.setItem(input.id, input.value);
      });

      const savedValue = sessionStorage.getItem(input.id);
      if (savedValue) {
        input.value = savedValue;
      }
    }

    // Add event listener for form submission
    form.addEventListener("submit", function () {
      if (validateForm()) {
        // Clear sessionStorage after successful submission
        sessionStorage.clear();
      }
    });
  }
});

// Add animation to cards
document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".lomba-card");
  cards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-10px)";
    });
    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)";
    });
  });
});
