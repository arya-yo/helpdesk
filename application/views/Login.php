<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tambah Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-light">

<?php if($this->session->flashdata('error')): ?>
    <div class="container mt-3">
        <div class="alert alert-danger text-center">
            <?= $this->session->flashdata('error'); ?>
        </div>
    </div>
<?php endif; ?>

<!-- SCRIPT SHOW/HIDE PASSWORD -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>

<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-md-5">
        <div class="card border-0 login-card">
            <!-- Header dengan gradient -->
            <div class="card-header text-center py-4 bg-gradient">
                <!-- Logo -->
                <img src="https://i.supaimg.com/9639a03d-fc19-4ae7-a17f-0257309bcd14.png" 
                     alt="Logo" class="mb-3" style="width:90px; height:auto;">
                <!-- Judul -->
                <h3 class="login-title">Sign in to <span>HELPDESK</span></h3>
            </div>
            <div class="card-body p-4 bg-white">
                <form action="<?= base_url('auth/login') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Username</label>
                        <input type="text" name="username"
                               class="form-control form-control-lg rounded-pill" 
                               placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Password</label>
                        <div class="position-relative">
                            <input type="password" id="password" name="password"
                                   class="form-control form-control-lg rounded-pill pe-5" 
                                   placeholder="Password" required>
                            <!-- Icon mata di dalam input -->
                            <span id="togglePassword" 
                                  class="position-absolute top-50 end-0 translate-middle-y me-3 text-secondary" 
                                  style="cursor:pointer;">
                                <i class="fa fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill shadow-sm">
                        <i class="fa fa-sign-in-alt me-2"></i> Sign in
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CSS KUSTOM -->
<style>
    body {
        background: linear-gradient(135deg, #dfe6e9, #ffffff);
        font-family: 'Poppins', sans-serif;
    }
    .login-card {
        border-radius: 25px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        box-shadow: 0 8px 25px rgba(10, 242, 145, 0.55); /* shadow jelas */
    }
    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(14, 248, 151, 1); /* shadow lebih dalam saat hover */
    }
    .bg-gradient {
        background: linear-gradient(135deg, #74b9ff, #0984e3);
        color: white;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* === STYLE JUDUL LOGIN === */
    .login-title {
        font-size: 28px;
        font-weight: 700;
        background: linear-gradient(135deg, #0984e3, #74b9ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: 1px;
        text-shadow: 2px 2px 5px rgba(0,0,0,0.1);
    }
    .login-title span {
        font-weight: 800;
        background: linear-gradient(135deg, #00cec9, #0984e3);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .form-control:focus {
        border-color: #0984e3;
        box-shadow: 0 0 0 0.2rem rgba(9,132,227,.25);
    }
    .btn-primary {
        background: linear-gradient(135deg, #0984e3, #74b9ff);
        border: none;
        font-weight: 600;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #74b9ff, #0984e3);
    }
    #togglePassword:hover {
        color: #0984e3;
    }
    label {
        font-weight: 500;
    }
</style>

</body>
</html>
