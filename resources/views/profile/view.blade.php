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
                <a href="{{ route('profile.edit') }}" class="btn btn text-orange">Edit Profil</a>
        </div>
        </div>
    </div>
    
</div>
@endsection