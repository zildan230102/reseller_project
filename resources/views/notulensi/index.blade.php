<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Daftar Notulensi</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h3 class="text-center mb-4">Daftar Notulensi</h3>
    
    <!-- Alert untuk pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Tempat</th>
                    <th>Pemimpin Musyawarah</th>
                    <th>Notulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notulensi as $notulen)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $notulen->tanggal }}</td>
                        <td>{{ $notulen->waktu }}</td>
                        <td>{{ $notulen->tempat }}</td>
                        <td>{{ $notulen->pemimpin_musyawarah }}</td>
                        <td>{{ $notulen->notulis }}</td>
                        <td>
                            <a href="{{ route('notulensi.show', $notulensi->id) }}" class="btn btn-info btn-sm">Lihat</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Link Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
