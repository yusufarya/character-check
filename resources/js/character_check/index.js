

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('#delete_data');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal')); // Inisialisasi modal Bootstrap
    const title = document.getElementById('deleteModalLabel');
    const charIdInput = document.getElementById('id');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const charId = this.getAttribute('data-id'); // Ambil data-id dari tombol
            const input_one = this.getAttribute('data-imput1'); // Ambil data-imput1 dari tombol

            title.textContent = 'Hapus Data ' + input_one + ' ?';  // Tambahkan teks di judul
            charIdInput.value = charId;  // Isi input dengan id yang didapatkan
            deleteModal.show();  // Tampilkan modal
        });
    });
});
