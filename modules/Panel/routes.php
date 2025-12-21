<?php

    use Papyrus\Http\Router;

    Router::get("/panel", [Module\Panel\Controllers\PanelController::class, 'index'])
            ->addMiddleware(Module\Panel\Middlewares\CheckAuthMiddleware::class)
            ->name("panel.dashboard");

    Router::get("/panel/profile", [Module\Panel\Controllers\PanelController::class, "profile"])
            ->addMiddleware(Module\Panel\Middlewares\CheckAuthMiddleware::class)
            ->name("panel.profile");

    Router::patch("/panel/profile", [Module\Panel\Controllers\PanelController::class, "updateProfile"])
            ->addMiddleware(Module\Panel\Middlewares\CheckAuthMiddleware::class)
            ->name("panel.profile.update");

    Router::patch("/panel/profile-password", [Module\Panel\Controllers\PanelController::class, "updatePassword"])
            ->addMiddleware(Module\Panel\Middlewares\CheckAuthMiddleware::class)
            ->name("panel.profile.password");
