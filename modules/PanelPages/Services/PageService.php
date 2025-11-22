<?php 

    namespace Module\PanelPages\Services;

    use Exception;
    use Module\Main\ServiceResult;
    use Module\PanelPages\Repositories\PageRepository;

    class PageService
    {
        private PageRepository $pageRepository;

        public function __construct() {
            $this->pageRepository = new PageRepository();
        }

        public function getPageListing($id, $request) {
            $result = new ServiceResult();

            try {
                $totalRows = (int) $this->pageRepository->getCountByBook($id);
                $limit = 10;
                $currentPage = (int) $request->param("page") ?? 1;
                $currentPage = max(1, $currentPage);
                $totalPages = ceil($totalRows / $limit);
                $offset = ($currentPage - 1) * $limit;
                $query = $this->pageRepository->getPaginatedListingByBook($id, $limit, $offset);

                $prev_page = $currentPage - 1;
                $prev_page = $prev_page < 0 ? 0 : $prev_page;
                $next_page = $currentPage + 1;
                $next_page = $next_page > $totalPages ? 0 : $next_page;

                $result->setSuccess(true);
                $result->setData([
                    "pages" => $query,
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

        public function createPage($book_id, $request) {
            $result = new ServiceResult();

            try {
                $query = $this->pageRepository->create($book_id, $request);
                
                $result->setSuccess(true);
                $result->setMessage("Page has been created successfully.");
                $result->setData([
                    "id" => $query->getId()
                ]);
            } catch (Exception $e) {
                $result->setSuccess(false);
                $result->setMessage($e->getMessage());
            }

            return $result;
        }

        public function getChapterTitles($book_id) {
            return $this->pageRepository->getChapterTitles($book_id);
        }

        public function findPageById($page_id) {
            $result = new ServiceResult();

            try {
                $query = $this->pageRepository->findById($page_id);
                if($query->count() > 0) {
                    $page = $query->first();
                    $metadata = getMetaData($page["metadata"]);
                    $result->setSuccess(true);
                    $result->setData([
                        "page" => $page,
                        "banner_url" => get_banner_url($page["banner"]),
                        "meta_title" => $metadata["title"],
                        "meta_description" => $metadata["description"],
                        "meta_tags" => $metadata["tags"]
                    ]);
                } else {
                    throw new Exception("Page Not Found.");
                }
            } catch(Exception $e) {
                $result->setSuccess(false);
                $result->setMessage($e->getMessage());
            }

            return $result;
        }
    }
