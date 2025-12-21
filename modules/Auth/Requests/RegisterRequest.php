<?php

namespace Module\Auth\Requests;

use Papyrus\Http\Request;
use Papyrus\Http\Traits\Validateable;

class RegisterRequest extends Request
{
    use Validateable;

    protected function secure()
    {
        return [
            "password",
            "confirm_password"
        ];
    }

    protected function handle()
    {
        //
    }

    protected function validate()
    {
        $this->field("name", $this->input("name"))
            ->required("Name is required");

        $this->field("username", $this->input("username"))
            ->required("Username is required");

        $this->field("email", $this->input("email"))
            ->required("Email is required")
            ->email("Invalid email format");

        $this->field("password", $this->input("password"))
            ->required("Password is required")
            ->equals($this->input("confirm_password"), "Password is not same as confirm password");
    }
}
