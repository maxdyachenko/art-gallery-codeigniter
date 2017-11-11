<body class="front-page">
<div class="alert alert-danger alert-email-check hidden" role="alert">
</div>
<div class="container-fluid">
    <div class="row justify-content-between">
        <div class="col-md-3 front-box">
            <form action="/auth" class="sign-in <?php if (isset($this->errors) && !empty($this->errors)) echo 'disable' ?>" method="post">
                <div class="form-group">
                    <label for="InputEmail1">Email address</label>
                    <input type="email" class="form-control" id="authEmail" aria-describedby="emailHelp"
                           placeholder="Enter email" name="authEmail">
                    <div class="invalid-feedback">Invalid email</div>
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" placeholder="Password"
                           name="authPswd">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="rememberMe">
                        Remember me
                    </label>
                </div>
                <div class="buttons-container">
                    <button type="button" class="btn btn-primary" name="auth" id="signin-button">Sign in</button>
                    <button type="button" class="btn btn-primary" id="signup-button">Register</button>
                </div>
            </form>
            <form class="sign-up" method="post">
                <div class="form-group">
                    <label for="regEmail">Email address</label>
                    <input type="email" class="form-control" id="regEmail" name="regEmail" aria-describedby="emailHelp"
                           placeholder="Enter email" value=""
                           required>
                    <div class="invalid-feedback">Invalid email</div>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="regPswd">Password</label>
                    <input type="password" class="form-control" id="regPswd" name="regPswd" placeholder="Password"
                           required>
                    <div class="invalid-feedback">Min 6 chars max 16 chars</div>
                    <small id="password-help" class="form-text text-muted">Minimum 6 symbols.</small>
                </div>
                <div class="form-group">
                    <label for="regPswd2">Confirm Password</label>
                    <input type="password" class="form-control" id="regPswd2" name="regPswd2"
                           placeholder="Confirm Password" required>
                    <div class="invalid-feedback">Passwords do not match</div>
                </div>
                <div class="form-group">
                    <label for="regName">Your Name</label>
                    <input type="text" class="form-control" name="regName" id="regName" placeholder="Your Name"
                           value="" required>
                    <div class="invalid-feedback">Min 2 chars max 16 chars</div>
                    <small id="password-help" class="form-text text-muted">Minimum 2 symbols.</small>
                </div>
                <div class="form-group">
                    <label for="regLastName">Your Last Name</label>
                    <input type="text" class="form-control" name="regLastName" id="regLastName"
                           placeholder="Your Last Name"
                           value="" required>
                    <div class="invalid-feedback">Min 2 chars max 16 chars</div>
                    <small id="password-help" class="form-text text-muted">Minimum 2 symbols.</small>
                </div>

                <button type="button" class="btn btn-primary" name="register" id="registerButton">Sign Up</button>
            </form>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/front-page.js"></script>
</body>
</html>