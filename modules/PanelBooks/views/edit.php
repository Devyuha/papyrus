<?php $template->includes("includes/header", null, "Panel") ?>

<div class="content-section">
    <div class="section-header">
        <div class="d-flex justify-content-between align-content-center">
            <span class="title">Edit Book</span>
            <a href="<?= route("panel.books") ?>">
                <button class="btn btn-sm btn-warning">Back</button>
            </a>
        </div>
    </div>

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
