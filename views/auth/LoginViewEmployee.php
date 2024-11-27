<title>Login</title>
<head>
    <?php include '../partials/header.php'; ?>
</head>
<body class="login-body">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card login-card shadow-lg">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-5 border-end d-flex flex-column justify-content-center align-items-center">
                        <img class="img-fluid logo mb-3" src="../../assets/img/logo.png" alt="logo-cafpath" style="max-width: 200px;">
                        <h4 class="text-center mb-2">CafPath</h4>
                        <p class="text-center text-muted">Welcome back! Please login to your account.</p>
                    </div>
                    
                    <div class="col-md-7 ps-md-4">
                        <form action="../../app/Controllers/AuthController.php" method="post">
                            <h3 class="text-center mb-4">EMPLOYEE LOGIN</h3>
                            
                            <div class="mb-4">
                                <input type="user" class="form-control" name="username" required placeholder="Username">
                            </div>
                            
                            <div class="mb-4 position-relative">
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                                <span id="togglePassword" class="password-toggle">
                                    <svg id="eyeOff" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5S0 8 0 8s.939 1.721 2.641 3.238l-.702.702a.5.5 0 0 0 .707.707l.702-.702c1.305 1.007 2.836 1.755 4.652 1.755 1.816 0 3.347-.748 4.652-1.755l.702.702a.5.5 0 0 0 .707-.707l-.702-.702zM8 13c1.816 0 3.347-.748 4.652-1.755l-.702-.702A6.713 6.713 0 0 1 8 12c-1.268 0-2.39-.375-3.367-.962l-.702.702C5.347 12.252 6.878 13 8 13z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                    <svg id="eyeOn" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" style="display: none;">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </span>
                            </div>
                            
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mb-4">Login</button>
                            
                            <div class="text-center">
                                <a href="#" class="text-decoration-none d-block mb-3">Forgot password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include '../partials/footerViews.php'; ?>
</html>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeOff = document.getElementById('eyeOff');
        const eyeOn = document.getElementById('eyeOn');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        
        if (type === 'password') {
            eyeOff.style.display = 'block';
            eyeOn.style.display = 'none';
        } else {
            eyeOff.style.display = 'none';
            eyeOn.style.display = 'block';
        }
    });
</script>