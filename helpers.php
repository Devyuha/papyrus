<?php

use Module\Auth\Facades\AuthUser;

function form_method($method = "DELETE")
{
    return '<input type="hidden" name="_method" value="' . $method . '">';
}

function auth()
{
    return AuthUser::init();
}

function sidebar_options($param = "dashboard")
{
    $list = [
        "dashboard" => [
            "panel.dashboard"
        ],
        "articles" => [
            "panel.articles",
            "panel.articles.create",
            "panel.articles.edit"
        ],
        "books" => [
            "panel.books",
            "panel.books.create",
            "panel.books.edit",
            "panel.books.view"
        ]
    ];

    return $list[$param] ?? [];
}
