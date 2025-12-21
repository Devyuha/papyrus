<?php

    namespace Module\Panel\Requests;

    use Papyrus\Http\Request;
    use Papyrus\Http\Traits\Validateable;
    
    class UpdateProfileRequest extends Request
    {
        use Validateable;
        protected function secure() {
            return [
                // Inputs to be secured and should not be remembered.
            ];
        }

        protected function handle() {
            // add/modify request data
        }

        protected function validate() {
            $this->field("name", $this->input("name"))
                ->required("Name is required");

            $this->field("email", $this->input("email"))
                ->required("Email is required")
                ->email("Invalid email");
        }
    }
