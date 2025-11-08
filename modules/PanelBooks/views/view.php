<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Books",
    "pageNavs" => ["Home", "Books", $book["title"]],
    "buttons" => [
        [
            "link" => route("panel.books"),
            "class" => "btn btn-sm btn-warning",
            "text" => "Back"
        ]
    ]
], "Panel") ?>

<div class="content-section">
    <div class="section-body">
        <?php $this->includes("includes/messages", null, "Auth") ?>

        <p>This is a book view page</p>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>