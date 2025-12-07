<?php

    namespace Module\PanelPages\Requests;

    use Papyrus\Http\Request;
    use Papyrus\Http\Traits\Validateable;
    
    class UpdateOrderRequest extends Request
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
            $this->field("pages_order", $this->input("pages_order"))
                ->required("Pages order is missing.");
        }
    }
