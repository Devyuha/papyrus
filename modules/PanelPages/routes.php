<?php

    use Papyrus\Http\Router;

    Router::get("/panelpages", [Module\PanelPages\Controllers\PanelPagesController::class, 'index']);