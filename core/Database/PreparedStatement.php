<?php

namespace Papyrus\Database;

use PDO;
use PDOStatement;

class PreparedStatement {
    private PDOStatement $stmt;

    public function __construct(PDOStatement $stmt) {
        $this->stmt = $stmt;
    }

    public function value(string $key, $value) {
        $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
        $this->stmt->bindValue($key, $value, $type);

        return $this;
    }

    public function execute() {
        return $this->stmt->execute();
    }

    public function getStatement() {
        return $this->stmt;
    }
}
