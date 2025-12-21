<?php

use Module\Auth\Facades\AuthUser;
use Papyrus\Support\Storage;
use Module\Main\Facades\Get;

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

function getMetaData($data) {
    $data = json_decode($data, true);

    return [
        "title" => $data["title"] ?? "",
        "description" => $data["description"] ?? "",
        "tags" => $data["tags"] ?? ""
    ];
}

function get_url($params) {
    $get = Get::init();
    if(count($params) > 0) {
        foreach($params as $key => $value) {
            $get->param($key, $value);
        }
    }

    return $get->generate();
}
