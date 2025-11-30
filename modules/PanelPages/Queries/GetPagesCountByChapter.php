<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class GetPagesCountByChapter extends Query {
        public function sql() {
            return <<<SQL
                SELECT count(id) as count FROM pages WHERE book_id = :book_id AND parent_id = :parent_id;
            SQL;
        }
    }
