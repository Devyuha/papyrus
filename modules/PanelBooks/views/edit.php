<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Edit Book",
    "pageNavs" => ["Home", "Books", "Edit"],
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
            "formUrl" => route("panel.books.update", ["id" => $book["id"]]),
            "title" => $book["title"],
            "description" => $book["description"],
            "slug" => $book["slug"],
            "tags" => $book["tags"],
            "banner_url" => $banner_url ?? null,
            "meta_title" => $meta_title,
            "meta_tags" => $meta_tags,
            "meta_description" => $meta_description
        ], "PanelBooks") ?>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>
