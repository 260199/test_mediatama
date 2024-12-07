    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("subscribe-button").addEventListener("click", function(event) {
            event.preventDefault(); 
            var email = prompt("Masukkan alamat email Anda untuk berlangganan:");
            if (email) {
                alert("Terima kasih telah berlangganan di situs berita kami.");
            }
        });
    });


    // Fungsi untuk membuka modal
function openModal() {
    document.getElementById("authorModal").style.display = "block";
}

// Fungsi untuk menutup modal
function closeModal() {
    document.getElementById("authorModal").style.display = "none";
}

// Klik di luar modal untuk menutupnya
window.onclick = function(event) {
    if (event.target == document.getElementById("authorModal")) {
        closeModal();
    }
}
