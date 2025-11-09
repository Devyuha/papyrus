<?php

    namespace Module\PanelArticles\Repositories;

    use Papyrus\Database\Pdo;
    use Module\PanelArticles\Queries\GetArticleCount;
    use Module\PanelArticles\Queries\PaginateArticles;
    use Module\PanelArticles\Queries\FindArticleById;
    use Module\PanelARticles\Queries\UpdateArticleStatus;

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
    }