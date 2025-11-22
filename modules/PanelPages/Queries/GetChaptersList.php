<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class GetChaptersList extends Query {
        public function sql() {
            return <<<SQL
                SELECT id, title FROM pages WHERE book_id = :book_id AND type = "chapter" ORDER BY id DESC;            
            SQL;
        }
    }
