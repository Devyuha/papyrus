<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class GetPagesByChapter extends Query {
        public function sql() {
            return <<<SQL
                SELECT
                    id, title, type, order_no, created_at, status
                FROM
                    pages
                WHERE
                    book_id = :book_id
                AND
                    parent_id = :parent_id
                ORDER BY id DESC
                LIMIT :limit
                OFFSET :offset
            SQL;
        }
    }
