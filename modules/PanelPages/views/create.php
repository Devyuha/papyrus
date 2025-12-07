<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Create New Page",
    "pageNavs" => ["Home", "Books", "Pages", "Create"],
    "buttons" => [
        [
            "link" => route("panel.books.view", ["id" => $book["id"]]),
            "class" => "btn btn-sm btn-warning",
            "text" => "Back"
        ]
    ]
], "Panel") ?>

<div class="content-section">
    <div class="section-body">
        <?php $template->includes("pageform", [
            "formUrl" => route("panel.pages.add", ["id" => $book["id"]]),
            "chapters" => $chapters ?? null,
            "type" => $type,
            "parent_id" => $parent
        ], "PanelPages") ?>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>
