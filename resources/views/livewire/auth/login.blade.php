<div>
    <div class="container-login d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center">
                        <h2 class="text-orange reseller">Reseller Deepublish</h2>
                        <p class="lead">Masuk ke akun Anda untuk melanjutkan</p>
                    </div>
                    <div class="card log">
                        <div class="card-login">
                            <div class="form-login m-sm-3">
                                <form wire:submit.prevent="loginUser">
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
                                        <div class="position-relative">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                                placeholder="Masukkan password" wire:model.defer="password">
                                            <i class="bi bi-eye eye-icon" id="togglePassword"></i>
                                        </div>
                                        @error('password')
                                        <div class="ivalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="form-check align-items-center">
                                            <input id="remember" type="checkbox" class="form-check-input"
                                                value="remember-me" name="remember-me" wire:model.defer="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-login mt-3">Masuk</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3 text-italic">
                        Belum memiliki akun? Yuk <a href="{{ route('register') }}">registrasi</a> sekarang!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>