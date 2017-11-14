<body class="edit-profile">

<div class="content">
    <section class="container content-container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?php if ($active_tab == 1) echo 'active' ?>" data-toggle="tab" href="#name" role="tab">Name</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($active_tab == 2) echo 'active' ?>" data-toggle="tab" href="#pswd" role="tab">Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($active_tab == 3) echo 'active' ?>" data-toggle="tab" href="#avatar" role="tab">Avatar</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane <?php if ($active_tab == 1) echo 'active' ?>" id="name" role="tabpanel">
                <div class="invalid-feedback visible"><?php if (!validation_errors() && isset($name_changed)) echo $name_changed;  ?></div>
                <?php echo form_open('edit-profile/edit-name', "class='user-edit-form'") ?>
                    <div class="form-group">
                        <label for="nameInput">First Name</label>
                        <input type="text" class="form-control" name="userName" id="nameInput" aria-describedby="lastName" value="<?php echo set_value('userName'); ?>" placeholder="Enter New First Name">
                        <div class="invalid-feedback visible"><?php echo form_error('userName'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="lastNameInput">Last Name</label>
                        <input type="text" class="form-control" id="lastNameInput" name="userLastName" aria-describedby="lastName" value="<?php echo set_value('userLastName'); ?>" placeholder="Enter New Last Name">
                        <div class="invalid-feedback visible"><?php echo form_error('userLastName'); ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="editNameForm">Submit</button>
                </form>
            </div>
            <div class="tab-pane <?php if ($active_tab == 2) echo 'active' ?>" id="pswd" role="tabpanel">
                <div class="invalid-feedback visible"><?php if (isset($pswd_changed)) echo $pswd_changed; ?></div>
                <?php echo form_open('edit-profile/edit-pswd', "class='pswd-edit-form'") ?>
                    <div class="form-group">
                        <label for="InputPassword1">Old Password</label>
                        <input type="password" class="form-control" name="oldPswd" id="InputPassword1" placeholder="Old Password" required>
                        <div class="invalid-feedback visible"><?php echo form_error('oldPswd'); ?></div>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword2">New Password</label>
                        <input type="password" class="form-control" name="newPswd" id="InputPassword2" placeholder="New Password" required>
                        <div class="invalid-feedback visible"><?php echo form_error('newPswd'); ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="editPswdForm">Submit</button>
                </form>
            </div>
            <div class="tab-pane <?php if ($active_tab == 3) echo 'active' ?>" id="avatar" role="tabpanel">
                <?php echo form_open_multipart('edit-profile/edit-avatar', "class='avatar-edit-form'") ?>
                <div class="invalid-feedback visible"><?php if (isset($file_loaded)) echo $file_loaded; ?></div>
                    <label class="custom-file">
                        <input type="file" id="file2" name="file" class="custom-file-input" required>
                        <span class="custom-file-control"></span>
                    </label><br>
                    <div class="invalid-feedback visible"><?php if (isset($file_error)) echo $file_error; ?></div>
                    <button type="submit" class="btn btn-primary" name="editAvatarForm">Submit</button>
                </form>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>/public/js/edit-page.js"></script>
</body>
</html>
