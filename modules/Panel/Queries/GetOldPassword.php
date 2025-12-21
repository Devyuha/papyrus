<?php

    namespace Module\Panel\Queries;

    use Papyrus\Database\Query;

    class GetOldPassword extends Query {
        public function sql() {
            return <<<SQL
                SELECT password FROM users WHERE id = :id LIMIT 1;
            SQL;
        }
    }
