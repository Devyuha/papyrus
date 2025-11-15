<?php 

    namespace Module\PanelPages\Repositories;

    use Papyrus\Database\Pdo;
    use Module\PanelPages\Queries\PaginatePages;
    use Module\PanelPages\Queries\GetPageCount;
    use Module\PanelPages\Queries\CreatePageQuery;

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

        public function create($book_id, $request) {
            return Pdo::execute(new CreatePageQuery([
                ":title" => $request->sanitizeInput("title"),
                ":content" => $request->input("content"),
                ":banner" => upload_banner_image($request->file("banner")),
                ":tags" => $request->sanitizeInput("tags"),
                ":slug" => $request->sanitizeInput("slug"),
                ":metadata" => json_encode([
                    "title" => $request->sanitizeInput("meta_title") ?? "",
                    "description" => $request->sanitizeInput("meta_description") ?? "",
                    "tags" => $request->sanitizeInput("meta_tags") ?? ""
                ]),
                ":type" => $request->sanitizeInput("type", "page"),
                ":book_id" => $book_id,
                ":parent_id" => (int) $request->sanitizeInput("parent", 0)
            ]));
        }
    }
