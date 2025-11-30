<?php

namespace Module\PanelPages\Controllers;

use Module\PanelBooks\Services\BookService;
use Papyrus\Http\Controller;
use Papyrus\Support\Facades\Flash;
use Module\PanelPages\Requests\CreatePageRequest;
use Module\PanelPages\Services\PageService;
use Module\PanelPages\Requests\UpdatePageRequest;
use Module\PanelPages\Requests\UpdateStatusRequest;
use Papyrus\Http\Request;

class PanelPagesController extends Controller
{
    public function index() {
        echo "This is the PanelPages module.";
    }

    public function createPage($id) {
        $request = new Request();
        
        $bookResult = (new BookService)->findBookById($id);
        if(!$bookResult->getSuccess()) {
            Flash::make("error", $bookResult->getMessage());
            return response()->redirect(route("panel.books"));
        }
        $bookData = $bookResult->getData();
        $book = $bookData["book"];
        $chapters = (new PageService)->getChapterTitles($id);

        $type = $request->param("type", "page");
        $parent = $request->param("parent", null);
        
        return view("create", compact("book", "chapters", "type", "parent"))
            ->module("PanelPages")
            ->render();
    }

    public function editPage($book_id, $page_id) {
        $bookResult = (new BookService)->findBookById($book_id);
        if(!$bookResult->getSuccess()) {
            Flash::make("error", $bookResult->getMessage());
            return response()->redirect(route("panel.books.view", ["id" => $book_id]));
        }

        $pageResult = (new PageService)->findPageById($page_id);
        if(!$pageResult->getSuccess()) {
            Flash::make("error", $pageResult->getMessage());
            return response()->redirect(route("panel.books.view", ["id" => $book_id]));
        }
        
        $bookData = $bookResult->getData();
        $book = $bookData["book"];
        $chapters = (new PageService)->getChapterTitles($book_id);

        $pageData = $pageResult->getData();
        $page = $pageData["page"];

        return view("edit", compact("book", "chapters", "page", "pageData"))
            ->module("PanelPages")
            ->render();
    }

    public function addPage($id) {
        $request = new CreatePageRequest();
        if(!$request->validated()) {
            $request->remember();
            Flash::make("error", $request->errors());
            return response()->redirect(route("panel.books.view", ["id" => $id]));
        }

        $service = new PageService();
        $result = $service->createPage($id, $request);
        $responseStatus = $result->getSuccess() ? "success" : "error";
        Flash::make($responseStatus, $result->getMessage());

        return response()->redirect(route("panel.books.view", ["id" => $id]));
    }

    public function updatePage($book_id, $page_id) {
        $request = new UpdatePageRequest();
        if(!$request->validated()) {
            $request->remember();
            Flash::make("error", $request->errors());
            return response()->redirect(route("panel.books.view", ["id" => $book_id]));
        }

        $service = new PageService();
        $response = $service->updatePage($request, $page_id);
        $status = $response->getSuccess() ? "success" : "error";
        Flash::make($status, $response->getMessage());
        return response()->redirect(route("panel.books.view", ["id" => $book_id]));
    }

    public function updatePageStatus($book_id, $page_id) {
        $request = new UpdateStatusRequest();
        if(!$request->validated()) {
            Flash::make("error", $request->errors());
            return response()->redirect(route("panel.books.view", ["id" => $book_id]));
        }

        $service = new PageService();
        $result = $service->updatePageStatus($request, $page_id);
        $status = $result->getSuccess() ? "success" : "error";
        Flash::make($status, $result->getMessage());
        return response()
                ->redirect(route("panel.books.view", [
                    "id" => $book_id
                ]));
    }

    public function viewPage($book_id, $page_id) {
        $service = new PageService();
        $request = new Request();

        $chapterResult = $service->findPageById($page_id);
        if(!$chapterResult->getSuccess()) {
            Flash::make("error", $chapterResult->getMessage());
            return response()->redirect(route("panel.books.view", ["id" => $book_id]));
        }

        $pageResult = $service->getPageListingByChapter($page_id, $book_id, $request);
        if(!$pageResult->getSuccess()) {
            Flash::make("error", $pageResult->getMessage());
        }
        $pageData = $pageResult->getData();
        $pages = $pageData["pages"];

        $chapterData = $chapterResult->getData();
        $chapter = $chapterData["page"];

        return view("view", compact("chapter", "pages"))
            ->module("PanelPages")
            ->render();
    }
}
