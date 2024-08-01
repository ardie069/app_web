<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Register - NiceAdmin Bootstrap Template" name="title">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/profile/img/logo_jatim.png" rel="icon">
    <link href="assets/profile/img/logo_jatim.png" rel="apple-touch-icon">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="assets/profile/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/profile/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/profile/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/profile/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/profile/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/profile/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/profile/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/profile/css/style.css" rel="stylesheet">
    <title>Daftar Akun</title>
</head>

<body>

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="/" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/user/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">SIPPEKA</span>
                                </a>
                            </div>
                            <!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                                        <p class="text-center small">Masukkan informasi Anda untuk membuat akun!</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="post" action="/auth/register">
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Silakan pilih nama pengguna!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email Kamu</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">Silakan masukkan email yang benar!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="userPwd" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Silakan masukkan password kamu!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourRepeatPassword" class="form-label">Ulangi Password</label>
                                            <input type="password" name="password" class="form-control" id="yourRepeatPassword" required>
                                            <div class="invalid-feedback">Silakan masukkan password ulang!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">Saya setuju dengan <a href="#">syarat dan ketentuan</a></label>
                                                <div class="invalid-feedback">Anda harus menyetujui sebelum mengirimkan.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" name="submit">Buat Akun</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah mempunyai akun? <a href="/login">Masuk</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="credits">
        <div class="container">
            <p class="text-center">All rights reserved. &copy; 2024.</p>
        </div>
    </footer>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="assets/profile/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/profile/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/profile/vendor/chart.js/chart.min.js"></script>
    <script src="assets/profile/vendor/echarts/echarts.min.js"></script>
    <script src="assets/profile/vendor/quill/quill.min.js"></script>
    <script src="assets/profile/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/profile/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/profile/vendor/php-email-form/validate.js"></script>
    <script src="assets/profile/js/main.js"></script>
</body>

</html>