<html>
<head>
    <title>Daftar Toko</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <div class="flex items-center">
                <img alt="Deepublish Digital Logo" class="h-10" height="50" src="https://storage.googleapis.com/a1aa/image/7hmUc7bN807xFdpTvuN3eXGdNfNeBTfMiOipAvzOJeMxSV6cC.jpg" width="150"/>
                <ul class="flex space-x-4 ml-6">
                    <li><a class="text-orange-500" href="#">Dashboard</a></li>
                    <li><a class="text-orange-500" href="#">Pesanan</a></li>
                    <li><a class="text-orange-500" href="#">Toko</a></li>
                    <li><a class="text-orange-500" href="#">Pembayaran</a></li>
                </ul>
            </div>
            <div class="relative">
                <i class="fas fa-bell text-gray-600"></i>
                <span class="absolute top-0 right-0 inline-block w-4 h-4 bg-blue-500 text-white text-xs font-bold rounded-full text-center">4</span>
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Toko</h1>
        <button class="bg-blue-500 text-white px-4 py-2 rounded mb-4" onclick="document.getElementById('modal').classList.remove('hidden')">Tambah Toko</button>
        <table class="min-w-full bg-white shadow-md rounded mb-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nama Toko</th>
                    <th class="py-2 px-4 border-b">Marketplace</th>
                    <th class="py-2 px-4 border-b">Tanggal Dibuat</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">Buka Buku</td>
                    <td class="py-2 px-4 border-b">Bukalapak</td>
                    <td class="py-2 px-4 border-b">30-09-2024</td>
                    <td class="py-2 px-4 border-b text-red-500">Aktif</td>
                    <td class="py-2 px-4 border-b">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded">Nonaktifkan</button>
                        <button class="bg-blue-500 text-white px-2 py-1 rounded">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded" data-id="1" data-toggle="modal" data-target="#confirmDeleteModal">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white shadow-md rounded p-4 w-1/3">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Tambah Toko</h2>
                    <button class="text-gray-500" onclick="document.getElementById('modal').classList.add('hidden')">×</button>
                </div>
                <form id="tokoForm" action="/toko" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Toko</label>
                        <input class="w-full px-3 py-2 border rounded" placeholder="Masukkan nama toko" type="text" name="nama_toko"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Marketplace</label>
                        <input class="w-full px-3 py-2 border rounded" placeholder="Masukkan nama marketplace" type="text" name="marketplace"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Tanggal Dibuat</label>
                        <input class="w-full px-3 py-2 border rounded" placeholder="dd/mm/yyyy" type="text" name="tanggal_dibuat"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status</label>
                        <select class="w-full px-3 py-2 border rounded" name="status">
                            <option>Aktif</option>
                            <option>Nonaktif</option>
                        </select>
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
        <div id="confirmDeleteModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white shadow-md rounded p-4 w-1/3">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Konfirmasi Hapus</h2>
                    <button class="text-gray-500" onclick="document.getElementById('confirmDeleteModal').classList.add('hidden')">×</button>
                </div>
                <p>Apakah Anda yakin ingin menghapus toko ini?</p>
                <form id="deleteForm" method="POST">
                    <button class="bg-red-500 text-white px-4 py-2 rounded mt-4">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Konfirmasi penghapusan toko
            $('#confirmDeleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var tokoId = button.data('id'); // Ambil ID toko dari tombol yang diklik
                var actionUrl = '/toko/' + tokoId; // Buat URL action untuk form hapus

                // Set URL action untuk form hapus
                $('#deleteForm').attr('action', actionUrl);
            });

            // Handle pengiriman form dengan AJAX untuk menambah toko
            $('#tokoForm').on('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form secara default

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#modal').addClass('hidden'); // Tutup modal
                        location.reload(); // Reload halaman untuk melihat data terbaru
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menyimpan data');
                    }
                });
            });
        });
    </script>
</body>
</html>