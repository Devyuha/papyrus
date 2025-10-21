<?php $template->includes("layouts/header") ?>

<div class="auth-page">
    <div class="auth-dialog">
        <div class="header">
            <h2>Forgot Password</h2>
        </div>
        <div class="body">
            <?php $template->includes("includes/messages") ?>
            <form method="post" action="<?= route("auth.post-forgot") ?>">
                <?= csrf_field() ?>
                <div class="flex flex-col gap-2">
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="form-submit">Verify Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $template->includes("layouts/footer", ["module" => "Auth"]); ?>
