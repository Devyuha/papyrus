<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class FindPageById extends Query {
        public function sql() {
            return <<<SQL
                SELECT
                    id, title, content, created_at, slug, tags, banner, metadata, type, book_id, parent_id, status, order_no
                FROM
                    pages
                WHERE
                    id = :page_id
            SQL;
        }
    }
