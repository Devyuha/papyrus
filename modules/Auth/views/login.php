<?php $template->includes("layouts/header") ?>

<div class="auth-page">
    <div class="auth-dialog">
        <div class="header">
            <h2>Login</h2>
        </div>
        <div class="body">
            <?php $template->includes("includes/messages") ?>
            <form method="post" action="<?= route("auth.signin") ?>">
                <?= csrf_field() ?>
                <div class="flex flex-col gap-2">
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= old('email') ?>" required />
                    </div>
    
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required />
                    </div>
    
                    <div class="form-group">
                        <a href="<?= route("auth.forgot") ?>" class="link">Forgot password?</a>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="form-submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->includes("layouts/footer") ?>
