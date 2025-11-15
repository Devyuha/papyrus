<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class CreatePageQuery extends Query {
        public function sql() {
            return <<<SQL
                INSERT INTO pages
                    (title, content, slug, tags, banner, metadata, type, book_id, parent_id)
                VALUES
                    (:title, :content, :slug, :tags, :banner, :metadata, :type, :book_id, :parent_id)
            SQL;
        }
    }
