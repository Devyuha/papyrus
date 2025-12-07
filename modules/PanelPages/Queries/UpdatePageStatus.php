<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;

    class UpdatePageStatus extends Query {
        public function sql() {
            return <<<SQL
                UPDATE pages SET status = :status WHERE id = :id;
            SQL;
        }
    }
