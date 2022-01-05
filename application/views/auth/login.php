<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h2 class="m-0"><b>Welcome to</b></h2>
            <a href="<?= base_url('homepage'); ?>" class="h2"><b>English Ivy Coffee!</b></a>
        </div>
        <div class="card-body" style="padding-top: 10px;">
            <p class="login-box-msg">Sign in to start your session</p>
            <div id="flash-login" data-flash="<?= $this->session->flashdata('flashLogin'); ?>"></div>
            <div id="flash-logout" data-flash="<?= $this->session->flashdata('flashLogout'); ?>"></div>
            <form action="<?= base_url('auth'); ?>" method="post">
                <div class="form-group mb-2">
                    <div class="input-group">
                        <input class="form-control <?= form_error('email') ? 'is-invalid' : null; ?>" placeholder="Email" type="text" id="email" name="email" value="<?= set_value('email'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('email', '<small class="text-danger m-r-10">', '</small>'); ?>
                </div>
                <div class="form-group mb-2">
                    <div class="input-group">
                        <input class="form-control <?= form_error('password') ? 'is-invalid' : null; ?>" placeholder="Password" type="password" id="password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password', '<small class="text-danger m-r-10">', '</small>'); ?>
                </div>
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                </div>
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary-ivy btn-block">Sign In</button>
                </div>
            </form>
            <a href="<?= base_url('#') ?>">Forgot your password?</a><br>
            <a href="<?= base_url('#') ?>" class="text-center">Need an account?</a>
        </div>
    </div>
</div>