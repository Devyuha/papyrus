<?php

    namespace Module\PanelPages\Queries;

    use Papyrus\Database\Query;
    use Papyrus\Database\Traits\HasDynamicUpdate;

    class UpdatePageById extends Query {
        use HasDynamicUpdate;

        public function init() {
            $this->start("pages");
        }
        
        public function sql() {
            return $this->getQuery();
        }
    }
