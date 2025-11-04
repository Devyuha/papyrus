<?php

    namespace Module\PanelBooks\Queries;

    use Papyrus\Database\Query;
    use Papyrus\Database\Traits\HasDynamicUpdate;

    class UpdateBookById extends Query {
        use HasDynamicUpdate;

        public function init() {
            $this->start("books");
        }

        public function sql() {
            return $this->getQuery();
        }
    }