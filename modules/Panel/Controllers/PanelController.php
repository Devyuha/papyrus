<?php

namespace Module\Panel\Controllers;

use Module\Panel\Requests\ChangePasswordRequest;
use Papyrus\Http\Controller;
use Module\Panel\Requests\UpdateProfileRequest;
use Papyrus\Support\Facades\Flash;
use Module\Panel\Services\PanelService;
    
class PanelController extends Controller
{
    public function index() {
        return view("index")->module("Panel")->render();
    }

    public function profile() {
        return view("profile")->module("Panel")->render();
    }

    public function updateProfile() {
        $request = new UpdateProfileRequest();
        if(!$request->validated()) {
            Flash::make("error", $request->errors());
            return response()->redirect(route("panel.profile"));
        }

        $service = new PanelService();
        $response = $service->updateProfile($request);
        $status = $response->getSuccess() ? "success" : "error";

        Flash::make($status, $response->getMessage());
        return response()->redirect(route("panel.profile"));
    }

    public function updatePassword() {
        $request = new ChangePasswordRequest();
        if(!$request->validated()) {
            Flash::make("error", $request->errors());
            return response()->redirect(route("panel.profile"));
        }

        $service = new PanelService();
        $response = $service->updatePassword($request);
        $status = $response->getSuccess() ? "success" : "error";

        Flash::make($status, $response->getMessage());
        return response()->redirect(route("panel.profile"));
    }
}
