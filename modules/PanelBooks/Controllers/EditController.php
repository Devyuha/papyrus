<?php

namespace Module\PanelBooks\Controllers;

use Module\PanelBooks\Requests\UpdateBookRequest;
use Papyrus\Http\Controller;
use Papyrus\Support\Facades\Flash;
use Module\PanelBooks\Services\BookService;
use Module\PanelBooks\Requests\UpdateStatusRequest;

class EditController extends Controller
{
    public function index($id)
    {
        $service = new BookService();
        $result = $service->findBookById($id);

        if (!$result->getSuccess()) {
            Flash::make("error", $result->getMessage());
            return response()->redirect(route("panel.books"));
        }

        return view("edit", $result->getData())->module("PanelBooks")->render();
    }

    public function update($id)
    {
        $request = new UpdateBookRequest();
        if(!$request->validated()) {
            $request->remember();
            Flash::make("error", $request->errors());
            return response()
                    ->redirect(route("panel.books.edit", ["id" => $id]));
        }

        $service = new BookService();
        $response = $service->updateBook($request, $id);
        $status = $response->getSuccess() ? "success" : "error";
        Flash::make($status, $response->getMessage());
        return response()->redirect(route("panel.books"));
    }

    public function updateStatus($id) {
        $request = new UpdateStatusRequest();
        if(!$request->validated()) {
            $request->remember();
            Flash::make("error", $request->errors());
            return response()->redirect(route("panel.books"));
        }

        $service = new BookService();
        $result = $service->updateBookStatus($request, $id);
        $status = $result->getSuccess() ? "success" : "error";
        Flash::make($status, $result->getMessage());
        return response()->redirect(route("panel.books"));
    }
}
