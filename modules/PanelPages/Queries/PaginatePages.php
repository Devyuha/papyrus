<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class PaginatePages extends Query {
        public function sql() {
            return <<<SQL
                SELECT
                    id, title, order_no, type, status
                FROM
                    pages
                WHERE
                    book_id = :book_id
                ORDER BY id ASC
                LIMIT :limit
                OFFSET :offset
            SQL;
        }
    }