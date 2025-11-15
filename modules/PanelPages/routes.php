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
