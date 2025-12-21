<?php $template->includes("includes/header") ?>

        <?php $template->includes("includes/pagebar", [
                "pageTitle" => "Profile",
                "pageNavs" => ["Home", "Profile"]
        ]); ?>

        <!-- Content Section -->
        <div class="content-section">
            <div class="section-body">
                <?php $template->includes("includes/messages", null, "Auth") ?>
                <div class="grid grid-cols-1 gap-[30px] md:grid-cols-2">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Profile Settings</h2>
                        </div>
                        <div class="card-body">
                            <form action="<?= route("panel.profile.update") ?>" method="POST" class="panel-form">
                                <?= csrf_field() ?>
                                <?= form_method("PATCH") ?>
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= auth()->user("name") ?>" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= auth()->user("email") ?>" />
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-lg btn-sharp btn-primary" type="submit">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Change Password</h2>
                        </div>
                        <div class="card-body">
                            <form action="<?= route("panel.profile.password") ?>" method="POST" class="panel-form">
                                <?= csrf_field() ?>
                                <?= form_method("PATCH") ?>
                                <div class="form-group">
                                    <label class="control-label">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">New Password</label>
                                    <input type="password" name="new_password" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" />
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-lg btn-sharp btn-primary" type="submit">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php $template->includes("includes/footer") ?>
