<div>
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h2 class="text-orange">Reseller Deepublish</h2>
                        <p class="lead">
                            Masuk ke akun anda untuk melanjutkan
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-login">
                            <div class="m-sm-3">
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
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Masukkan password" wire:model.defer="password">
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
                    <div class="text-center mb-3">
                        Belum memiliki akun? <a href="{{ route('register') }}">Registrasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>