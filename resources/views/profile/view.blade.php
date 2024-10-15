@extends('layouts.profil')
@section('title', 'Profil')
@section('content')
<div class="container">
    <h2>Profil Pengguna</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body text-center">
            @if ($user->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}?{{ time() }}" alt="Foto Profil"
                class="rounded-circle" width="150" height="150">
            @else
            <img src="https://via.placeholder.com/150" alt="Foto Profil" class="rounded-circle" width="150"
                height="150">
            @endif

            <h4 class="mt-3">{{ $user->name }}</h4>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>No Telepon:</strong> {{ $user->phone }}</p>
            <p><strong>Alamat:</strong> {{ $user->address }}</p>
            <p><strong>Tanggal Bergabung:</strong>
                {{ $user->join_date ? \Carbon\Carbon::parse($user->join_date)->format('d M Y') : 'Belum ada' }}</p>

            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
        </div>
    </div>
</div>
@endsection