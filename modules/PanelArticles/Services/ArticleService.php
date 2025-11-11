<?php

namespace Module\PanelArticles\Services;

use Papyrus\Database\Pdo;
use Papyrus\Support\Storage;
use Exception;
use Module\Main\ServiceResult;
use Module\PanelArticles\Repositories\ArticleRepository;
use Module\PanelArticles\Queries\InsertArticle;
use Module\PanelArticles\Queries\UpdateArticleById;

class ArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct() {
        $this->articleRepository = new ArticleRepository();
    }

    public function addArticle($request)
    {
        $result = new ServiceResult();

        try {
            $query = Pdo::execute(new InsertArticle([
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

            $result->setSuccess(true);
            $result->setMessage("Article has been saved successfully.");
            $result->setData(["id" => $query->getId()]);
        } catch (Exception $e) {
            $request->remember();
            $result->setSuccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }

    public function updateArticle($request, $id)
    {
        $result = new ServiceResult();

        try {
            $queryClass = $this->articleRepository->updateById($id, $request);
            $query = Pdo::execute($queryClass);

            $result->setSuccess(true);
            $result->setMessage("Updated article successfully, rows effected : " . $query->getAffectedRows());
        } catch (Exception $e) {
            $result->setSuccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }

    public function getArticleListing($request)
    {
        $result = new ServiceResult();

        try {
            $totalRows = (int) $this->articleRepository->getCount();
            $limit = 10;
            $currentPage = (int) $request->param("page") ?? 1;
            $currentPage = max(1, $currentPage);
            $totalPages = ceil($totalRows / $limit);
            $offset = ($currentPage - 1) * $limit;
            $query = $this->articleRepository->getPaginatedListing($limit, $offset);

            $result->setSuccess(true);
            $result->setData([
                "articles" => $query
            ]);
        } catch (Exception $e) {
            $result->setSuccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }

    private function getBannerUrl($banner)
    {
        $path = "banners/" . $banner;
        $storage_path = Storage::has($path) ? Storage::url($path) : null;
        return $storage_path;
    }

    public function findArticleById($id)
    {
        $result = new ServiceResult();

        try {
            $query = $this->articleRepository->findById($id);
            if ($query->count() > 0) {
                $article = $query->first();
                $metadata = $this->getMetaData($article["metadata"]);
                $result->setSuccess(true);
                $result->setData([
                    "article" => $article,
                    "banner_url" => $this->getBannerUrl($article["banner"]),
                    "meta_title" => $metadata["title"] ?? "",
                    "meta_tags" => $metadata["tags"] ?? "",
                    "meta_description" => $metadata["description"] ?? ""
                ]);
            } else {
                throw new Exception("Article not found.");
            }
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

    public function updateArticleStatus($request, $id)
    {
        $result = new ServiceResult();

        try {
            $initialStatus = $request->sanitizeInput("status", "draft");
            $status = $initialStatus === "published" ? "draft" : "published";
            $query = $this->articleRepository->updateStatus($id, $status);
            if (!$query->getAffectedRows()) {
                throw new Exception("Error in updating status");
            }
            $result->setSuccess(true);
            $result->setMessage("Article status has been updated successfully");
        } catch (Exception $e) {
            $result->setSuccess(false);
            $result->setMessage($e->getMessage());
        }

        return $result;
    }
}
