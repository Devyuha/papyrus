<?php

use Module\Panel\Middlewares\CheckAuthMiddleware;
use Papyrus\Http\Router;
use Module\PanelPages\Controllers\PanelPagesController;

Router::get("/panel/books/{id}/page/create", [PanelPagesController::class, 'createPage'])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.pages.create");

Router::post("/panel/books/{id}/page/create", [PanelPagesController::class, 'addPage'])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.pages.add");

Router::get("/panel/books/{book_id}/page/{page_id}/edit", [PanelPagesController::class, "editPage"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.pages.edit");

Router::post("/panel/books/{book_id}/page/{page_id}/edit", [PanelPagesController::class, "updatePage"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.pages.update");

Router::patch("/panel/books/{book_id}/pages/{page_id}/status", [PanelPagesController::class, "updatePageStatus"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.pages.status");

Router::get("/panel/books/{book_id}/pages/{page_id}/view", [PanelPagesController::class, "viewPage"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.pages.view");

Router::patch("/panel/books/{book_id}/order", [PanelPagesController::class, "updateBookPagesOrder"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.pages.orderno");
