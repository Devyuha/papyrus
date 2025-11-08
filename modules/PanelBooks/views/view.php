<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Books",
    "pageNavs" => ["Home", "Books", $book["title"]]
], "Panel") ?>

<div class="content-section">
    <div class="section-header">
        <div class="d-flex justify-content-between align-content-center">
            <span class="title">Books</span>
            <a href="<?= route("panel.books.create") ?>">
                <button class="btn btn-sm btn-primary">Create</button>
            </a>
        </div>
    </div>

    <div class="section-body">
        <?php $this->includes("includes/messages", null, "Auth") ?>

        <p>This is a book view page</p>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>