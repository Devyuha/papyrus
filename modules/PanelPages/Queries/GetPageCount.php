<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class GetPageCount extends Query {
        public function sql() {
            return <<<SQL
                SELECT COUNT(id) as count FROM pages WHERE book_id = :book_id;
            SQL;
        }
    }