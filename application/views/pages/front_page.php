<body class="front-page">
<div class="alert alert-danger alert-email-check hidden" role="alert">
</div>
<div class="container-fluid">
    <div class="row justify-content-between">
        <div class="col-md-3 front-box">
            <?php echo form_open('auth', $auth_attr) ?>
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
            <?php echo form_open('register', $reg_attr); ?>
                <div class="form-group">
                    <label for="regEmail">Email address</label>
                    <input type="email" class="form-control" id="regEmail" name="regEmail" aria-describedby="emailHelp"
                           placeholder="Enter email" value="<?php echo set_value('regEmail'); ?>"
                           >
                    <div class="invalid-feedback visible"><?php echo form_error('regEmail'); ?></div>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="regPswd">Password</label>
                    <input type="password" class="form-control" id="regPswd" name="regPswd" placeholder="Password"
                           >
                    <div class="invalid-feedback visible"><?php echo form_error('regPswd'); ?></div>
                    <small id="password-help" class="form-text text-muted">Minimum 6 symbols.</small>
                </div>
                <div class="form-group">
                    <label for="regPswd2">Confirm Password</label>
                    <input type="password" class="form-control" id="regPswd2" name="regPswd2"
                           placeholder="Confirm Password" >
                    <div class="invalid-feedback visible"><?php echo form_error('regPswd2'); ?></div>
                </div>
                <div class="form-group">
                    <label for="regName">Your Name</label>
                    <input type="text" class="form-control" name="regName" id="regName" placeholder="Your Name"
                           value="<?php echo set_value('regName'); ?>" >
                    <div class="invalid-feedback visible"><?php echo form_error('regName'); ?></div>
                    <small id="password-help" class="form-text text-muted">Minimum 2 symbols.</small>
                </div>
                <div class="form-group">
                    <label for="regLastName">Your Last Name</label>
                    <input type="text" class="form-control" name="regLastName" id="regLastName"
                           placeholder="Your Last Name"
                           value="<?php echo set_value('regLastName'); ?>" >
                    <div class="invalid-feedback visible"><?php echo form_error('regLastName'); ?></div>
                    <small id="password-help" class="form-text text-muted">Minimum 2 symbols.</small>
                </div>

                <button type="submit" class="btn btn-primary" name="register" id="registerButton">Sign Up</button>
            </form>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/front-page.js"></script>
</body>
</html>