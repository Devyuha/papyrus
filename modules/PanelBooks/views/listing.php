<?php $template->includes("includes/header", null, "Panel") ?>

<?php $template->includes("includes/pagebar", [
    "pageTitle" => "Books",
    "pageNavs" => ["Home", "Books"]
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

        <?php if (isset($books) && $books->count() > 0) : ?>
            <div class="table-responsive">
                <table class="table table-bordred">
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
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
    </div>
</div>

<?php $template->includes("includes/footer", null, "Panel") ?>
