<?php

    namespace Module\PanelArticles\Repositories;

    use Papyrus\Database\Pdo;
    use Module\PanelArticles\Queries\GetArticleCount;
    use Module\PanelArticles\Queries\PaginateArticles;
    use Module\PanelArticles\Queries\FindArticleById;
    use Module\PanelArticles\Queries\UpdateArticleStatus;
    use Module\PanelArticles\Queries\UpdateArticleById;
    use Module\PanelArticles\Queries\InsertArticle;

    class ArticleRepository
    {
        public function getCount() {
            $query = Pdo::execute(new GetArticleCount());
            $count = $query->first()["count"] ?? 0;

            return $count;
        }

        public function getPaginatedListing($limit, $offset) {
            return Pdo::execute(new PaginateArticles([
                ":limit" => (int) $limit,
                ":offset" => (int) $offset
            ]));
        }

        public function findById($id) {
            return Pdo::execute(new FindArticleById([":id" => $id]));
        }

        public function updateStatus($id, $status) {
            return Pdo::execute(new updateArticleStatus([
                ":status" => $status,
                ":id" => $id
            ]));
        }

        public function updateById($id, $request) {
            $query = new UpdateArticleById();
            $query->init();
            $data = [];
            $data[":id"] = $id;
            $metadata = [
                "title" => $request->sanitizeInput("meta_title") ?? "",
                "tags" => $request->sanitizeInput("meta_tags") ?? "",
                "description" => $request->sanitizeInput("meta_description") ?? ""
            ];

            if ($request->hasInput("title")) {
                $query->update("title", ":title");
                $data[":title"] = $request->sanitizeInput("title");
            }

            if ($request->hasInput("content")) {
                $query->update("content", ":content");
                $data[":content"] = $request->input("content");
            }

            if ($request->hasInput("slug")) {
                $query->update("slug", ":slug");
                $data[":slug"] = $request->sanitizeInput("slug");
            }

            if ($request->hasInput("tags")) {
                $query->update("tags", ":tags");
                $data[":tags"] = $request->sanitizeInput("tags");
            }

            if ($request->hasFile("banner")) {
                $banner = upload_banner_image($request->file("banner"));
                $query->update("banner", ":banner");
                $data[":banner"] = $banner;
            }
            $query->update("metadata", ":metadata");
            $data[":metadata"] = json_encode($metadata);
            $query->where("WHERE id = :id");
            $query->setArgs($data);

            return Pdo::execute($query);
        }

        public function create($request) {
            return Pdo::execute(new InsertArticle([
                ":title" => $request->sanitizeInput("title"),
                ":content" => $request->input("content"),
                ":banner" => upload_banner_image($request->file("banner")),
                ":tags" => $request->sanitizeInput("tags"),
                ":slug" => $request->sanitizeInput("slug"),
                ":metadata" => json_encode([
                    "title" => $request->sanitizeInput("meta_title") ?? "",
                    "description" => $request->sanitizeInput("meta_description") ?? "",
                    "tags" => $request->sanitizeInput("meta_tags") ?? ""
                ])
            ]));
        }
    }