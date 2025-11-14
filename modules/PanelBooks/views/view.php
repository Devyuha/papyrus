<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Books",
    "pageNavs" => ["Home", "Books", $book["title"]],
    "buttons" => [
        [
            "link" => route("panel.pages.create", ["id" => $book["id"]]),
            "class" => "btn btn-sm btn-primary",
            "text" => "Create Page"
        ],
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

        <p>Total Books are : <?= $pages->count(); ?></p>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>