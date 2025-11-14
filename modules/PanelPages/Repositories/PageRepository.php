<?php 

    namespace Module\PanelPages\Repositories;

    use Papyrus\Database\Pdo;
    use Module\PanelPages\Queries\PaginatePages;
    use Module\PanelPages\Queries\GetPageCount;

    class PageRepository
    {
        public function getPaginatedListingByBook($bookId, $limit, $offset) {
            return Pdo::execute(new PaginatePages([
                ":book_id" => $bookId,
                ":limit" => $limit,
                ":offset" => $offset
            ]));
        }

        public function getCountByBook($bookId) {
            $query = Pdo::execute(new GetPageCount([
                ":book_id" => $bookId
            ]));
            $count = $query->first()["count"] ?? 0;

            return (int) $count;
        }
    }