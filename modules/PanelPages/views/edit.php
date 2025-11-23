<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Create New Page",
    "pageNavs" => ["Home", "Books", "Pages", "Edit"],
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
            "formUrl" => route("panel.pages.edit", ["book_id" => $book["id"], "page_id" => $page["id"]]),
            "chapters" => $chapters ?? null,
            "title" => $page["title"] ?? "",
            "content" => $page["content"] ?? "",
            "slug" => $page["slug"] ?? "",
            "parent_id" => $page["parent_id"] ?? "",
            "tags" => $page["tags"] ?? "",
            "banner_url" => $pageData["banner_url"] ?? "",
            "meta_title" => $pageData["meta_title"] ?? "",
            "meta_description" => $pageData["meta_description"] ?? "",
            "meta_tags" => $pageData["meta_tags"] ?? ""
        ], "PanelPages") ?>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>
