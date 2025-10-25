<?php

    namespace Module\PanelBooks\Queries;

    use Papyrus\Database\Query;

    class UpdateBookStatus extends Query {
        public function sql() {
            return <<<SQL
                UPDATE books SET status = :status WHERE id = :id;
            SQL;
        }
    }