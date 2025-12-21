<?php

    namespace Module\Panel\Queries;

    use Papyrus\Database\Query;

    class UpdateProfile extends Query {
        public function sql() {
            return <<<SQL
                UPDATE users SET name = :name, email = :email WHERE id = :id;
            SQL;
        }
    }
