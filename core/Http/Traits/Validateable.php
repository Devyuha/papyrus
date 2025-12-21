<?php

namespace Papyrus\Http\Traits;

trait Validateable
{
    protected $errors = [];

    public function field($key, $value)
    {
        return new class ($this, $key, $value) {
            private $parent;
            private $key;
            private $value;

            public function __construct($parent, $key, $value)
            {
                $this->parent = $parent;
                $this->key = $key;
                $this->value = $value;
            }

            public function file($message = "This field must be a valid file")
            {
                if (!isfile($this->value)) {
                    $this->parent->error($this->key, $message);
                }

                return $this;
            }

            public function mimes($allowedTypes, $message = "The file type is not allowed")
            {
                if (isfile($this->value)) {
                    $fifo = finfo_open(FILEINFO_MIME_TYPE);
                    $mime = finfo_file($fifo, $this->value["tmp_name"]);
                    finfo_close($fifo);

                    if (!in_array($mime, $allowedTypes)) {
                        $this->parent->error($this->key, $message);
                    }
                }

                return $this;
            }

            public function max_size($size, $message = "The file is exceeded allowed size")
            {
                $size = $size * 1024 * 1024;
                if (isfile($this->value)) {
                    if ($this->value["size"] > $size) {
                        $this->parent->error($this->key, $message);
                    }
                }
            }

            public function required($message = "This field is required")
            {
                if (!isset($this->value) || empty($this->value) || trim($this->value) === "") {
                    $this->parent->error($this->key, $message);
                }

                return $this;
            }

            public function email($message = "Invalid email format")
            {
                if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
                    $this->parent->error($this->key, $message);
                }

                return $this;
            }

            public function min_length($length, $message = "Length is low")
            {
                if (strlen($this->value) < $length) {
                    $this->parent->error($this->key, $message);
                }

                return $this;
            }

            public function max_length($length, $message = "Lengh exceeded")
            {
                if (strlen($this->value) > $length) {
                    $this->parent->error($this->key, $message);
                }

                return $this;
            }

            public function equals($match, $message = "Field is not same as given value.")
            {
                if ($this->value !== $match) {
                    $this->parent->error($this->key, $message);
                }

                return $this;
            }

            public function custom($callbask, $message = "Custom validation failed")
            {
                if (!call_user_func($callbask, $this->value)) {
                    $this->parent->error($this->key, $message);
                }

                return $this;
            }
        };
    }

    public function error($key, $message)
    {
        if (!array_key_exists($key, $this->errors)) {
            $this->errors[$key] = $message;
        }
    }

    public function validated()
    {
        $this->validate();
        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}
