<?php

namespace Module\PanelPages\Controllers;

use Module\PanelBooks\Services\BookService;
use Papyrus\Http\Controller;
use Papyrus\Support\Facades\Flash;

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
        
        return view("create", compact("book"))
            ->module("PanelPages")
            ->render();
    }
}