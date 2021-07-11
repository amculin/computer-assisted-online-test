<div class="layout-login-row">
    <div class="layout-login-col-img">
        <img class="bg-login-img" src="images/dummy/img-10.jpg" alt="" />
    </div>
    <div class="layout-login-col-desc">
        <div class="login-box">
            <div class="login-header">
                <img src="images/dummy/logo-3.png" alt="" />
                <h1>TARUNA EDUCATION</h1>
                <h2>LOGIN</h2>
            </div>
            <div class="login-form">
                <form id="form-login" method="post" action="index.php?pages=home">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group form-group-mjk">
                                <label for="login-email">Email</label>
                                <input type="email" class="form-control" id="login-email" name="email" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group form-group-mjk">
                                <label for="login-password">Password</label>
                                <input type="password" class="form-control" id="login-password" name="password" required />
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex align-items-center">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox check-mjk">
                                <input type="checkbox" class="custom-control-input" id="login-remember" name="rememberme" />
                                <label class="custom-control-label" for="login-remember">Ingatkan saya</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="index.php?pages=forgot-password" title="">Lupa Password?</a>
                        </div>
                    </div>

                    <div class="mt-3 mb-3">
                        <button type="submit" class="btn btn-mjk w-100" title="submit">MASUK</button>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <div class="mb-4">
                    <div class="title-login-footer center">
                        <h5>Belum memiliki akun? <a href="index.php?pages=register" title="">DAFTAR</a> disini </h5>
                    </div>
                </div>
            </div>
        </div>
        <img class="bg-login-desc" src="images/dummy/img-10.jpg" alt="" />
    </div>
</div>