<?php

namespace Module\PanelPages\Repositories;

use Exception;
use Papyrus\Database\Pdo;
use Module\PanelPages\Queries\PaginatePages;
use Module\PanelPages\Queries\GetPageCount;
use Module\PanelPages\Queries\CreatePageQuery;
use Module\PanelPages\Queries\GetChaptersList;
use Module\PanelPages\Queries\FindPageById;
use Module\PanelPages\Queries\UpdatePageById;
use Module\PanelPages\Queries\UpdatePageStatus;
use Module\PanelPages\Queries\GetPagesByChapter;
use Module\PanelPages\Queries\GetPagesCountByChapter;
use Module\PanelPages\Queries\UpdatePageOrder;

class PageRepository
{
    public function getPaginatedListingByBook($bookId, $limit, $offset)
    {
        return Pdo::execute(new PaginatePages([
            ":book_id" => $bookId,
            ":limit" => $limit,
            ":offset" => $offset
        ]));
    }

    public function getCountByBook($bookId)
    {
        $query = Pdo::execute(new GetPageCount([
            ":book_id" => $bookId
        ]));
        $count = $query->first()["count"] ?? 0;

        return (int) $count;
    }

    public function getCountByChapter($page_id, $book_id)
    {
        $query = Pdo::execute(new GetPagesCountByChapter([
            ":book_id" => $book_id,
            ":parent_id" => $page_id
        ]));
        $count = $query->first()["count"] ?? 0;

        return (int) $count;
    }

    public function create($book_id, $request)
    {
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

    public function getChapterTitles($book_id)
    {
        return Pdo::execute(new GetChaptersList([
            ":book_id" => $book_id
        ]));
    }

    public function findById($page_id)
    {
        return Pdo::execute(new FindPageById([
            ":page_id" => $page_id
        ]));
    }

    public function updateById($id, $request)
    {
        $query = new UpdatePageById();
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

    public function updateStatus($id, $status)
    {
        return Pdo::execute(new UpdatePageStatus([
            ":status" => $status,
            ":id" => $id
        ]));
    }

    public function getPaginatedListByChapter($book_id, $page_id, $limit, $offset)
    {
        return Pdo::execute(new GetPagesByChapter([
            ":book_id" => $book_id,
            ":parent_id" => $page_id,
            ":limit" => $limit,
            ":offset" => $offset
        ]));
    }

    public function updatePagesOrder($sequence)
    {
        Pdo::transaction();
        try {
            $stmt = Pdo::prepare(new UpdatePageOrder());
            
            foreach ($sequence as $id => $number) {
                $stmt->value(":order_no", $number)
                    ->value(":page_id", $id)
                    ->execute();
            }

            Pdo::commit();
        } catch (Exception $e) {
            Pdo::rollback();
            throw $e;
        }
    }
}
