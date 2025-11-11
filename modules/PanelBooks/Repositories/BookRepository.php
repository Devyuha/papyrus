<?php 

    namespace Module\PanelBooks\Repositories;

    use Papyrus\Database\Pdo;
    use Module\PanelBooks\Queries\InsertBook;
    use Module\PanelBooks\Queries\GetBookCount;
    use Module\PanelBooks\Queries\PaginateBooks;
    use Module\PanelBooks\Queries\FindBookById;
    use Module\PanelBooks\Queries\UpdateBookById;
    use Module\PanelBooks\Queries\UpdateBookStatus;

    class BookRepository 
    {
        public function create($request) {
            return Pdo::execute(new InsertBook([
                ":title" => $request->sanitizeInput("title"),
                ":description" => $request->input("description"),
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

        public function getCount() {
            $query = Pdo::execute(new GetBookCount());
            $count = $query->first()["count"];

            return (int) $count;
        }

        public function getPaginatedListing($limit, $offset) {
            return Pdo::execute(new PaginateBooks([
                ":limit" => (int) $limit,
                ":offset" => (int) $offset
            ]));
        }

        public function findById($id) {
            return Pdo::execute(new FindBookById([":id" => $id]));
        }

        public function updateById($id, $request) {
            $query = new UpdateBookById();
            $query->init();
            $data = [];
            $data[":id"] = $id;
            $metadata = [
                "title" => $request->sanitizeInput("meta_title") ?? "",
                "tags" => $request->sanitizeInput("meta_tags") ?? "",
                "description" => $request->sanitizeInput("meta_description") ?? ""
            ];

            if($request->hasInput("title")) {
                $query->update("title", ":title");
                $data[":title"] = $request->sanitizeInput("title");
            }

            if ($request->hasInput("description")) {
                $query->update("description", ":description");
                $data[":description"] = $request->input("description");
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

        public function updateStatus($id, $status) {
            return Pdo::execute(new updateBookStatus([
                ":status" => $status,
                ":id" => $id
            ]));
        }
    }