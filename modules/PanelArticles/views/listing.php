<?php $template->includes("includes/header", null, "Panel") ?>

    <?php $template->includes("includes/pagebar", [
        "pageTitle" => "Articles",
        "pageNavs" => ["Home", "Articles"],
        "buttons" => [
            [
                "class" => "btn btn-sm btn-primary",
                "text" => "Create",
                "link" => route("panel.articles.create")
            ]
        ]
    ], "Panel") ?>

    <div class="content-section">
        <div class="section-body">
            <?php $this->includes("includes/messages", ["meta" => $meta], "Auth") ?>

            <?php if (isset($articles) && $articles->count() > 0) : ?>
                <?php $template->component("components/table", null, "Main") ?>
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
                        <?php foreach ($articles->getData() as $article) : ?>
                            <tr>
                                <td><?= $article["id"] ?? "" ?></td>
                                <td><?= $article["title"] ?? "" ?></td>
                                <td><?= $article["created_at"] ?? "" ?></td>
                                <td>
                                    <form action='<?= route("panel.articles.status", ["id" => $article["id"]]) ?>' method="POST" onsubmit="return confirm('Are you sure you want to update?')">
                                <?= form_method("PATCH") ?>
                                        <input type="hidden" name="status" value="<?= $article['status'] ?? 'draft' ?>" />
                                        <?php if ($article["status"] === "published") : ?>
                                            <button type="submit" class="btn btn-sm btn-success">Published</button>
                                        <?php elseif ($article["status"] === "draft") : ?>
                                            <button type="submit" class="btn btn-sm btn-warning">Draft</button>
                                        <?php endif ?>
                                    </form>
                                </td>
                                <td>
                                    <a href="<?= route("panel.articles.edit", ["id" => $article['id']]) ?>">
                                        <button class="btn btn-sm btn-primary">Edit</button>
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
