<?php

namespace Module\PanelPages\Controllers;

use Module\PanelBooks\Services\BookService;
use Papyrus\Http\Controller;
use Papyrus\Support\Facades\Flash;
use Module\PanelPages\Requests\CreatePageRequest;
use Module\PanelPages\Services\PageService;

class PanelPagesController extends Controller
{
    public function index() {
        echo "This is the PanelPages module.";
    }

    public function createPage($id) {
        $bookResult = (new BookService)->findBookById($id);
        if(!$bookResult->getSuccess()) {
            Flash::make("error", $bookResult->getMessage());
            return response()->redirect(route("panel.books"));
        }
        $bookData = $bookResult->getData();
        $book = $bookData["book"];
        $chapters = (new PageService)->getChapterTitles($id);
        
        return view("create", compact("book", "chapters"))
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
}
