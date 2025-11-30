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
                AND
                    (parent_id IS NULL OR parent_id = 0)
                ORDER BY id ASC
                LIMIT :limit
                OFFSET :offset
            SQL;
        }
    }
