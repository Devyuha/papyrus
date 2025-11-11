<?php

use Module\Auth\Facades\AuthUser;
use Papyrus\Support\Storage;

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

function upload_banner_image($file)
{
    $name = date("Ymdhsi");
    $storage = Storage::open($file, $name, "banners");
    if ($storage->upload()) {
        return $storage->getName();
    }

    return null;
}

function get_banner_url($banner) {
    $path = "banners/" . $banner;
    $storage_path = Storage::has($path) ? Storage::url($path) : null;
    return $storage_path;
}