<?php

namespace Module\PanelArticles\Services;

use Exception;
use Module\Main\ServiceResult;
use Module\PanelArticles\Repositories\ArticleRepository;

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
            $query = $this->articleRepository->create($request);

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
            $query = $this->articleRepository->updateById($id, $request);

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
                    "banner_url" => get_banner_url($article["banner"]),
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
