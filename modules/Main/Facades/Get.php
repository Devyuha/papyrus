<?php

    namespace Module\Main\Facades;

    class Get {
        public static $instance = null;
        private $url;
        private $params = [];

        public function __construct() {
            $this->fetchUrl();
        }

        private function fetchUrl() {
            $current_url = explode("?", route());
            if(count($current_url) > 0) {
                $this->url = $current_url[0];
            }
            $this->params = $_GET;
        }

        public function param($key, $value="") {
            $this->params[$key] = $value;
        }

        public function generate() {
            $url_params = http_build_query($this->params);
            $url = $this->url . "?" . $url_params;

            return $url;
        }

        public static function init() {
            if(self::$instance === null) {
                self::$instance = new self();
            }

            return self::$instance;
        }
    }
