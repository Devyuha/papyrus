<?php

use Module\Panel\Middlewares\CheckAuthMiddleware;
use Papyrus\Http\Router;

Router::get("/panel/books/{id}/page/create", [Module\PanelPages\Controllers\PanelPagesController::class, 'createPage'])
    ->addMiddleware(CheckAuthMiddleware::class)
    ->name("panel.pages.create");