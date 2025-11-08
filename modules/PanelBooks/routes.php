<?php

use Papyrus\Http\Router;
use Module\Panel\Middlewares\CheckAuthMiddleware;
use Module\PanelBooks\Controllers\PanelBooksController;
use Module\PanelBooks\Controllers\CreateController;
use Module\PanelBooks\Controllers\EditController;

Router::get("/panel/books", [PanelBooksController::class, "index"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.books");

Router::get("/panel/books/create", [CreateController::class, "index"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.books.create");

Router::post("/panel/books/create", [CreateController::class, "addBook"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.books.add");

Router::get("/panel/books/{id}/edit", [EditController::class, "index"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.books.edit");

Router::post("/panel/books/{id}/edit", [EditController::class, "update"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.books.update");

Router::patch("/panel/books/{id}/status", [EditController::class, "updateStatus"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.books.status");

Router::get("/panel/books/{id}/view", [PanelBooksController::class, "viewBook"])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.books.view");