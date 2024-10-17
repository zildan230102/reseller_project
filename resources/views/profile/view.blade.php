@extends('layouts.profil')
@section('title', 'Profil')
@section('content')


<div class="container mt-3">
    <h2>Profil Pengguna</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 mt-3">
        <div class="card-title text-center">
            @if ($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}?{{ time() }}" alt="Foto Profil"
                class="rounded-circle mt-5" width="150" height="150">
            @else
            <img src="https://via.placeholder.com/150" alt="Foto Profil" class="rounded-circle" width="150"
                height="150">
            @endif

            <h4 class="mt-5">{{ $user->name }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>No Telepon</th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal bergabung</th>
                        <td>{{ $user->join_date ? \Carbon\Carbon::parse($user->join_date)->format('d M Y') : 'Belum ada' }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- Tombol yang memicu modal untuk edit profil -->
            <button type="button" class="custom-button" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                Edit Profil
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="fullName">Nama Lengkap:</label>
                <input type="text" id="fullName" name="fullName" class="form-control" value="{{ old('fullName', $user->name) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="joinDate">Tanggal Bergabung:</label>
                <input type="date" id="joinDate" name="joinDate" class="form-control" value="{{ old('joinDate', $user->join_date) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="address">Alamat:</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $user->address) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="phone">No Telepon:</label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="profilePicture">Unggah Foto Profil:</label>
                <input type="file" id="profilePicture" name="profilePicture" class="form-control" accept="image/*">
            </div>

            <div class="modal-footer">
              <button type="button" class="custom-button btn-sm" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="custom-button btn-sm">Simpan Perubahan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
