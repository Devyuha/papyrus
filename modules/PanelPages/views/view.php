<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => $chapter["title"] ?? "View Chapter",
    "pageNavs" => ["Home", "Chapter", $chapter["title"]],
    "buttons" => [
        [
            "link" => route("panel.pages.create", [
                "id" => $chapter["book_id"]
            ], [
                "type" => "page",
                "parent" => $chapter["id"]
            ]),
            "class" => "btn btn-sm btn-primary",
            "text" => "Create Page"
        ],
        [
            "link" => route("panel.books.view", ["id" => $chapter["book_id"]]),
            "class" => "btn btn-sm btn-warning",
            "text" => "Back"
        ]
    ]
], "Panel") ?>

<div class="content-section">
    <div class="section-body">
        <?php $this->includes("includes/messages", null, "Auth") ?>

        <?php if (isset($pages) && $pages->count() > 0) : ?>
            <?php $template->component("components/table", null, "Main") ?>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pages->getData() as $page) : ?>
                    <tr>
                        <td><?= $page["id"] ?></td>
                        <td><?= $page["title"] ?></td>
                        <td>
                            <span class="table-label <?= $page["type"] ?>"><?= ucfirst($page["type"]) ?></span>
                        </td>
                        <td>
                            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to update?')">
                                <?= form_method("PATCH") ?>
                                <input type="hidden" name="book_id" value="<?= $book["id"] ?>" />
                                <input type="hidden" name="page_id" value="<?= $page["id"] ?>" />
                                <select class="table-input" name="order_no">
                                    <option value="" disabled <?= is_null($page["order_no"]) ? "selected" : "" ?>></option>
                                    <?php for ($i = 1; $i <= $pages->count(); $i++) : ?>
                                        <option
                                            value="<?= $i ?>"
                                            <?= $page["order_no"] == $i ? "selected" : "" ?>>
                                            <?= $i ?>
                                        </option>
                                    <?php endfor ?>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form action='<?= route("panel.pages.status", ["book_id" => $chapter["book_id"], "page_id" => $page["id"]]) ?>' method="POST" onsubmit="return confirm('Are you sure you want to update?')">
                                <?= form_method("PATCH") ?>
                                <input type="hidden" name="status" value="<?= $page['status'] ?? 'draft' ?>" />
                                <?php if ($page["status"] === "published") : ?>
                                    <button type="submit" class="btn btn-sm btn-success">Published</button>
                                <?php elseif ($page["status"] === "draft") : ?>
                                    <button type="submit" class="btn btn-sm btn-warning">Draft</button>
                                <?php endif ?>
                            </form>
                        </td>
                        <td>
                            <a href="<?= route("panel.pages.edit", [
                                            "book_id" => $chapter['book_id'],
                                            "page_id" => $page["id"]
                                        ]) ?>">
                                <button class="btn btn-sm btn-primary">Edit</button>
                            </a>
                            <?php if ($page["type"] === "chapter") : ?>
                                <a href="">
                                    <button class="btn btn-sm btn-info">View</button>
                                </a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <?php $template->endComponent() ?>
        <?php else : ?>
            <p>No Pages Found!</p>
        <?php endif ?>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>
