<script>
$(function() {
    // Setup CSRF Token for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Saat Provinsi diubah
    $('#provinsi').on('change', function() {
        let id_provinsi = $(this).val();
        $.ajax({
            type: 'POST',
            url: "{{ route('getkabupaten') }}", // Route untuk mendapatkan data kabupaten
            data: {
                id_provinsi: id_provinsi
            },
            success: function(response) {
                $('#kota').html(
                response); // Isi dropdown kabupaten dengan data yang diterima
                $('#kecamatan').html(
                    '<option value="" disabled selected>Pilih Kecamatan</option>'
                    ); // Reset kecamatan
                $('#kelurahan').html(
                    '<option value="" disabled selected>Pilih Kelurahan</option>'
                    ); // Reset kelurahan
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });

    // Saat Kabupaten diubah
    $('#kota').on('change', function() {
        let id_kabupaten = $(this).val();
        $.ajax({
            type: 'POST',
            url: "{{ route('getkecamatan') }}", // Route untuk mendapatkan data kecamatan
            data: {
                id_kabupaten: id_kabupaten
            },
            success: function(response) {
                $('#kecamatan').html(
                response); // Isi dropdown kecamatan dengan data yang diterima
                $('#kelurahan').html(
                    '<option value="" disabled selected>Pilih Kelurahan</option>'
                    ); // Reset kelurahan
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });

    // Saat Kecamatan diubah
    $('#kecamatan').on('change', function() {
        let id_kecamatan = $(this).val();
        $.ajax({
            type: 'POST',
            url: "{{ route('getkelurahan') }}", // Route untuk mendapatkan data kelurahan
            data: {
                id_kecamatan: id_kecamatan
            },
            success: function(response) {
                $('#kelurahan').html(
                response); // Isi dropdown kelurahan dengan data yang diterima
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const bukuContainer = document.getElementById('buku-container');
    const totalBeratInput = document.getElementById('total_berat');
    const grandTotalInput = document.getElementById('grand_total');

    // Fungsi untuk menghitung total berat dan grand total
    function calculateTotals() {
        let totalBerat = 0;
        let grandTotal = 0;

        document.querySelectorAll('.books-row').forEach(function (row) {
            const bukuSelect = row.querySelector('.buku-select');
            const jumlahInput = row.querySelector('.jumlah-input');

            if (bukuSelect && jumlahInput) {
                const berat = parseFloat(bukuSelect.options[bukuSelect.selectedIndex]?.dataset?.berat || 0);
                const harga = parseFloat(bukuSelect.options[bukuSelect.selectedIndex]?.dataset?.harga || 0);
                const jumlah = parseInt(jumlahInput.value || 0);

                totalBerat += berat * jumlah;
                grandTotal += harga * jumlah;
            }
        });

        // Update total berat dan grand total
        totalBeratInput.value = totalBerat.toFixed(2);
        grandTotalInput.value = grandTotal.toFixed(2);
    }

    // Event listener untuk perubahan pada buku atau jumlah
    bukuContainer.addEventListener('input', function (e) {
        if (e.target.classList.contains('buku-select') || e.target.classList.contains('jumlah-input')) {
            calculateTotals();
        }
    });

    // Fungsi untuk menambahkan baris buku baru
    function addBukuRow() {
        const rowCount = document.querySelectorAll('.books-row').length;
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'align-items-center', 'mb-2', 'books-row');
        newRow.id = `buku-row-${rowCount}`;
        newRow.innerHTML = `
            <div class="col-7 col-sm-4 col-md-7">
                <select name="bukus[${rowCount}][id]" class="form-select buku-select" required>
                    <option value="" data-berat="0" data-harga="0" disabled selected>Pilih Buku</option>
                    @foreach($bukus as $buku)
                    <option value="{{ $buku->id }}" data-berat="{{ $buku->berat }}" data-harga="{{ $buku->harga }}">
                        {{ $buku->judul_buku }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 col-sm-3 col-md-3">
                <input type="number" name="bukus[${rowCount}][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" required>
            </div>
            <div class="col-1 d-flex">
                <i class="bi bi-dash-circle text-danger fs-4 cursor-pointer remove-buku" title="Hapus Buku"></i>
            </div>
        `;
        bukuContainer.appendChild(newRow);
    }

    // Fungsi untuk menghapus baris buku
    function removeBukuRow(row) {
        row.remove();
        calculateTotals(); // Recalculate total after removal
    }

    // Event listener untuk tombol tambah buku
    bukuContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-buku')) {
            addBukuRow();
        }

        if (e.target.classList.contains('remove-buku')) {
            const row = e.target.closest('.books-row');
            if (row) removeBukuRow(row);
        }
    });
});


// Sembunyikan tombol hapus pada baris pertama
const firstRow = document.querySelector('.buku-row');
if (firstRow) {
    const removeButton = firstRow.querySelector('.remove-buku');
    if (removeButton) {
        removeButton.style.display = 'none';
    }
}

// Update total berat dan grand total
function updateTotal(orderId) {
    let totalBerat = 0;
    let grandTotal = 0;

    const bukuContainer = document.getElementById('buku-container-' + orderId);
    const bukuRows = bukuContainer.querySelectorAll('.buku-row');

    bukuRows.forEach(function(row) {
        const bukuSelect = row.querySelector('.buku-select');
        const jumlahInput = row.querySelector('.jumlah-input');

        const berat = parseFloat(bukuSelect.options[bukuSelect.selectedIndex]?.getAttribute(
            'data-berat')) || 0;
        const harga = parseFloat(bukuSelect.options[bukuSelect.selectedIndex]?.getAttribute(
            'data-harga')) || 0;
        const jumlah = parseInt(jumlahInput.value) || 0;

        totalBerat += berat * jumlah;
        grandTotal += harga * jumlah;
    });

    // Update nilai total berat dan grand total
    document.getElementById('total_berat' + orderId).value = totalBerat.toFixed(2);
    document.getElementById('grand_total' + orderId).value = grandTotal.toFixed(2);
}

// Event listener untuk perubahan select buku atau input jumlah
document.querySelectorAll('.buku-select, .jumlah-input').forEach(function(input) {
    input.addEventListener('change', function() {
        const orderId = input.closest('.modal').querySelector('form').action.split('/')
            .pop(); // Mengambil ID order dari URL form
        updateTotal(orderId);
    });
});

// Panggil fungsi updateTotal saat modal dibuka
document.querySelectorAll('.modal').forEach(function(modal) {
    modal.addEventListener('shown.bs.modal', function() {
        const orderId = modal.querySelector('form').action.split('/')
            .pop(); // Mengambil ID order dari URL form
        updateTotal(orderId);
    });


    // Update marketplace berdasarkan toko yang dipilih
    const tokoSelect = document.getElementById('toko_id');
    const marketplaceInput = document.getElementById('asal_penjualan');
    const tanggalInput = document.getElementById('tanggal');

    tokoSelect.addEventListener('change', function() {
        const selectedOption = tokoSelect.options[tokoSelect.selectedIndex];
        const marketplaceValue = selectedOption.getAttribute('data-marketplace');
        marketplaceInput.value = marketplaceValue || '';
    });

    // Set tanggal input default ke hari ini
    const today = new Date().toISOString().split('T')[0];
    tanggalInput.value = today;
});

// Handler untuk menampilkan modal dan mengatur URL penghapusan
document.getElementById('deleteModal').addEventListener('show.bs.modal', function(event) {
    // Dapatkan tombol yang memicu modal
    const button = event.relatedTarget;
    // Ambil ID order dari atribut data
    const orderId = button.getAttribute('data-order-id');
    // Buat URL aksi untuk form
    const actionUrl = `/orders/${orderId}`;
    // Atur URL aksi pada form
    document.getElementById('deleteForm').setAttribute('action', actionUrl);
    // Set nilai hidden input untuk order ID
    document.getElementById('orderId').value = orderId;
});

// Handler untuk mengkonfirmasi penghapusan
document.getElementById('confirmDelete').addEventListener('click', function() {
    // Submit form
    document.getElementById('deleteForm').submit();
});


// Modal Toko dan Marketplace - Update marketplace saat toko berubah
function updateMarketplace(orderId) {
    var tokoSelect = document.getElementById("toko_id" + orderId);
    var marketplaceInput = document.getElementById("asal_penjualan" + orderId);
    var selectedOption = tokoSelect.options[tokoSelect.selectedIndex];
    var marketplace = selectedOption.getAttribute("data-marketplace");
    marketplaceInput.value = marketplace;
}

// Fungsi untuk pindah ke tab berikutnya
function tabSelanjutnya(tabId) {
    document.getElementById(tabId).click();
}

// Fungsi untuk pindah ke tab sebelumnya
function tabSebelumnya(tabId) {
    document.getElementById(tabId).click();
}

document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.querySelectorAll('input[type="date"]').forEach(function(input) {
        if (!input.value) {
            input.value = today;
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const bukuContainerSelector = '#buku-container-';

    // Tambahkan event listener untuk tombol tambah buku
    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('add-buku')) {
            const orderId = e.target.dataset.orderId;
            const container = document.querySelector(`${bukuContainerSelector}${orderId}`);
            const bukus = container.querySelector('.buku-select').innerHTML; // Salin opsi buku
            const nextIndex = container.querySelectorAll('.buku-row').length; // Hitung jumlah baris
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'align-items-center', 'mb-2', 'buku-row');
            newRow.innerHTML = `
                <div class="col-7 col-sm-4 col-md-7">
                    <select name="bukus[${nextIndex}][id]" class="form-select buku-select" required>
                        ${bukus}
                    </select>
                </div>
                <div class="col-3 col-sm-3 col-md-3">
                    <input type="number" name="bukus[${nextIndex}][jumlah]" class="form-control jumlah-input" placeholder="Jumlah" required>
                </div>
                <div class="col-1 d-flex">
                    <i class="bi bi-dash-circle text-danger fs-4 cursor-pointer remove-buku" title="Hapus Buku"></i>
                </div>
            `;
            container.appendChild(newRow);

            // Pastikan ikon tambah hanya ada di baris terakhir
            updateAddAndRemoveIcons(container);
        }
    });

    // Tambahkan event listener untuk tombol hapus buku
    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-buku')) {
            const row = e.target.closest('.buku-row');
            const container = row.parentElement;
            if (row) row.remove();

            // Pastikan ikon tambah hanya ada di baris terakhir
            updateAddAndRemoveIcons(container);
        }
    });

    // Fungsi untuk memperbarui ikon tambah dan hapus
    function updateAddAndRemoveIcons(container) {
        const rows = container.querySelectorAll('.buku-row');
        rows.forEach((row, index) => {
            const addIcon = row.querySelector('.add-buku');
            const removeIcon = row.querySelector('.remove-buku');

            if (index === 0) {
                // Baris pertama hanya memiliki ikon tambah
                if (removeIcon) removeIcon.style.display = 'none';
                if (addIcon) addIcon.style.display = 'block';
            } else if (index === rows.length - 1) {
                // Baris terakhir hanya memiliki ikon tambah
                if (removeIcon) removeIcon.style.display = 'block';
                if (addIcon) addIcon.style.display = 'block';
            } else {
                // Baris lainnya hanya memiliki ikon hapus
                if (removeIcon) removeIcon.style.display = 'block';
                if (addIcon) addIcon.style.display = 'none';
            }
        });
    }

    // Inisialisasi awal
    const containers = document.querySelectorAll(`${bukuContainerSelector}`);
    containers.forEach(container => {
        updateAddAndRemoveIcons(container);
    });
});

</script>