<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Books",
    "pageNavs" => ["Home", "Books"],
    "buttons" => [
        [
            "link" => route("panel.books.create"),
            "class" => "btn btn-sm btn-primary",
            "text" => "Create"
        ]
    ]
], "Panel") ?>

<div class="content-section">
    <div class="section-body">
        <?php $this->includes("includes/messages", null, "Auth") ?>

        <?php if (isset($books) && $books->count() > 0) : ?>
            <?php $template->component("components/table", ["meta" => $meta], "Main") ?>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books->getData() as $book) : ?>
                        <tr>
                            <td><?= $book["id"] ?? "" ?></td>
                            <td><?= $book["title"] ?? "" ?></td>
                            <td><?= $book["created_at"] ?? "" ?></td>
                            <td>
                                <form action='<?= route("panel.books.status", ["id" => $book["id"]]) ?>' method="POST" onsubmit="return confirm('Are you sure you want to update?')">
                                    <?= form_method("PATCH") ?>
                                    <input type="hidden" name="status" value="<?= $book['status'] ?? 'draft' ?>" />
                                    <?php if ($book["status"] === "published") : ?>
                                        <button type="submit" class="btn btn-sm btn-success">Published</button>
                                    <?php elseif ($book["status"] === "draft") : ?>
                                        <button type="submit" class="btn btn-sm btn-warning">Draft</button>
                                    <?php endif ?>
                                </form>
                            </td>
                            <td>
                                <a href="<?= route("panel.books.edit", ["id" => $book['id']]) ?>">
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                </a> 
                                <a href="<?= route("panel.books.view", ["id" => $book['id']]) ?>">
                                    <button class="btn btn-sm btn-info">View</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            <?php $template->endComponent() ?>
        <?php endif ?>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>
