<?php

    namespace Module\Panel\Requests;

    use Papyrus\Http\Request;
    use Papyrus\Http\Traits\Validateable;
    
    class ChangePasswordRequest extends Request
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
            $this->field("old_password", $this->input("old_password"))
                ->required("Old password is required.");

            $this->field("new_password", $this->input("new_password"))
                ->required("New password is required")
                ->equals($this->input("confirm_password", "Password and confirm password is not same."));
        }
    }
