@extends('layouts.profil')
@section('title', 'Perbarui Profil')
@section('content')
<div class="container">
    <h2>Edit Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="fullName">Nama Lengkap:</label>
            <input type="text" id="fullName" name="fullName" class="form-control" value="{{ old('fullName', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="joinDate">Tanggal Bergabung:</label>
            <input type="date" id="joinDate" name="joinDate" class="form-control" value="{{ old('joinDate', $user->join_date) }}" required>
        </div>

        <div class="form-group">
            <label for="address">Alamat:</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $user->address) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">No Telepon:</label>
            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="profilePicture">Unggah Foto Profil:</label>
            <input type="file" id="profilePicture" name="profilePicture" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
