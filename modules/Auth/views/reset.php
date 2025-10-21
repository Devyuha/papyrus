<?php $template->includes("layouts/header") ?>

<div class="auth-page">
    <div class="auth-dialog">
        <div class="header">
            <h2>Reset Password</h2>
        </div>
        <div class="body">
            <?php $template->includes("includes/messages") ?>
            <form method="post" action="<?= route("auth.reset-password") ?>">
                <?= csrf_field() ?>
                <div class="flex flex-col gap-2">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="form-submit">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $template->includes("layouts/footer") ?>
