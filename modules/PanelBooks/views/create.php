<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Create New Book",
    "pageNavs" => ["Home", "Books", "Create"],
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
        <?php $template->includes("bookform", [
            "formUrl" => route("panel.books.add")
        ], "PanelBooks") ?>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>
