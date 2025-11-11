<?php

namespace Module\PanelBooks\Services;

use Exception;
use Module\Main\ServiceResult;
use Module\PanelBooks\Repositories\BookRepository;

class BookService {
    private BookRepository $bookRepository;

    public function __construct() {
        $this->bookRepository = new BookRepository();
    }

    public function addBook($request) {
        $result = new ServiceResult();

        try {
            $query = $this->bookRepository->create($request);

            $result->setSuccess(true);
            $result->setMessage("Book has been saved successfully.");
            $result->setData(["id" => $query->getId()]);

        } catch (Exception $e) {
            $request->remember();
            $result->setSuccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }

    public function getBookListing($request) {
        $result = new ServiceResult();

        try {
            $totalRows = (int) $this->bookRepository->getCount();
            $limit = 10;
            $currentPage = (int) $request->param("page") ?? 1;
            $currentPage = max(1, $currentPage);
            $totalPages = ceil($totalRows / $limit);
            $offset = ($currentPage - 1) * $limit;
            $query = $this->bookRepository->getPaginatedListing($limit, $offset);

            $prev_page = $currentPage - 1;
            $prev_page = $prev_page < 0 ? 1 : $prev_page;
            $next_page = $currentPage + 1;
            $next_page = $next_page > $totalPages ? 0 : $next_page;

            $result->setSuccess(true);
            $result->setData([
                "books" => $query,
                "meta" => [
                    "total_pages" => $totalPages,
                    "current_page" => $currentPage,
                    "prev_page" => $prev_page,
                    "next_page" => $next_page
                ]
            ]);
        } catch(Exception $e) {
            $result->setSuccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }

    public function findBookById($id) {
        $result = new ServiceResult();

        try {
            $query = $this->bookRepository->findById($id);
            if ($query->count() > 0) {
                $book = $query->first();
                $metadata = $this->getMetaData($book["metadata"]);
                $result->setSuccess(true);
                $result->setData([
                    "book" => $book,
                    "banner_url" => get_banner_url($book["banner"]),
                    "meta_title" => $metadata["title"] ?? "",
                    "meta_tags" => $metadata["tags"] ?? "",
                    "meta_description" => $metadata["description"] ?? ""
                ]);
            } else {
                throw new Exception("Book not found.");
            }
        } catch(Exception $e) {
            $result->setSUccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }

    public function updateBook($request, $id) {
        $result = new ServiceResult();

        try {
            $query = $this->bookRepository->updateById($id, $request);

            $result->setSuccess(true);
            $result->setMessage("Updated book successfully, rows effected : " . $query->getAffectedRows());
        } catch(Exception $e) {
            $result->setSuccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }

    public function updateBookStatus($request, $id) {
        $result = new ServiceResult();

        try {
            $initialStatus = $request->sanitizeInput("status", "draft");
            $status = $initialStatus === "published" ? "draft" : "published";
            unset($initialStatus);
            $query = $this->bookRepository->updateStatus($id, $status);
            if (!$query->getAffectedRows()) {
                throw new Exception("Error in updating status");
            }
            $result->setSuccess(true);
            $result->setMessage("Book status has been updated successfully");
        } catch (Exception $e) {
            $result->setSuccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }

    private function getMetaData($data)
    {
        $data = json_decode($data, true);

        return $data;
    }
}
