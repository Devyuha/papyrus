<?php $template->includes("layouts/header") ?>

<div class="auth-page">
    <div class="auth-dialog">
        <div class="header">
            <h2>Verify Account</h2>
        </div>
        <div class="body">
            <?php $template->includes("includes/messages") ?>
            <form method="post" action="<?= route("auth.verify-answers") ?>">
                <?= csrf_field() ?>
                <div class="flex flex-col gap-2">
                    <div class="form-group">
                        <label class="control-label" for="answer_1">
                            <?= $question_1 ?>
                        </label>
                        <input type="text" class="form-control" name="answer_1" id="answer_1" placeholder="Your answer" required />
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="answer_2">
                            <?= $question_2 ?>
                        </label>
                        <input type="text" class="form-control" name="answer_2" id="answer_2" placeholder="Your answer" required />
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="answer_3">
                            <?= $question_3 ?>
                        </label>
                        <input type="text" class="form-control" name="answer_3" id="answer_3" placeholder="Your answer" required />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="form-submit">Verify Account</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $template->includes("layouts/footer") ?>
