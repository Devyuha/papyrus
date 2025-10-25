<?php

    namespace Module\PanelBooks\Requests;

    use Papyrus\Http\Request;
    use Papyrus\Http\Traits\Validateable;
    
    class UpdateStatusRequest extends Request
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
            $this->field("status", $this->input("status"))->required("Status is required.");
        }
    }