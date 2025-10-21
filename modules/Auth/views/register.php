<?php $this->includes("layouts/header") ?>

<div class="auth-page">
    <div class="auth-dialog">
        <div class="header">
            <h2>Register</h2>
        </div>
        <div class="body">
            <?php $template->includes("includes/messages") ?>
            <form method="post" action="<?= route("auth.register") ?>">
                <?= csrf_field() ?>
                <div class="flex flex-col gap-2">
                    <div class="form-group">
                        <label class="control-label" for="name">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" required />
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required />
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required />
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" required />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="form-submit">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $template->includes("layouts/footer") ?>
