<div>
    <div class="container-register d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                    <h2 class="text-orange reseller">Registrasi Akun</h2>
                    <p class="lead">Isi data di bawah ini untuk melanjutkan</p>
                    </div>

                    <div class="card log">
                        <div class="card-login">
                            <div class="m-sm-3">
                                <form wire:submit.prevent="registerUser">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" placeholder="Masukkan nama anda"  wire:model.defer="name">
                                        @error('name')
                                        <div class="ivalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" placeholder="Masukkan alamat email" wire:model.defer="email">
                                        @error('email')
                                        <div class="ivalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Masukkan password"  wire:model.defer="password">
                                        @error('password')
                                        <div class="ivalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Konfirmasi
                                            Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            placeholder="Masukkan ulang password" wire:model.defer="password_confirmation">
                                    </div>
                                    <button type="submit" class="btn btn-login">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3 text-italic">
                        Sudah memiliki akun? <a href="{{route('login')}}">Klik untuk masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>