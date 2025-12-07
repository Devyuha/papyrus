<?php

    namespace Module\PanelPages\Requests;

    use Papyrus\Http\Request;
    use Papyrus\Http\Traits\Validateable;
    
    class CreatePageRequest extends Request
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
            // validate your request data
            $this->field("title", $this->input("title"))
                ->required("Title is required")
                ->max_length("Title must be less than 255 characters");

            $this->field("slug", $this->input("slug"))
                ->required("Slug is required")
                ->max_length("Slug should be less than 300 characters");

            $this->field("banner", $this->file("banner"))
                ->file("Banner Image is not a valid file")
                ->mimes(["image/jpeg", "image/jpg", "image/png", "image/gif"], "Banner Image is not a valid image")
                ->max_size(5);
        }
    }
