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
    }