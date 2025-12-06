<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class UpdatePageOrder extends Query {
        public function sql() {
            return <<<SQL
                UPDATE pages SET order_no = :order_no WHERE id = :page_id
            SQL;
        }
    }
