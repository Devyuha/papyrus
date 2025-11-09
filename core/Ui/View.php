<?php

    namespace Papyrus\Ui;

    use Papyrus\Ui\Template;

    class View {
        private Template $engine;

        public function __construct(Template $engine) {
            $this->engine = $engine;
        }

        public function includes(string $path, array|null $args = null, string|null $module = null) {
            $this->engine->includes($path, $args, $module);
        }

        public function component(string $component, array|null $props = null, ?string $module = null) {
            $this->engine->component($component, $props, $module);
        }

        public function endComponent() {
            $this->engine->endComponent();
        }
    }
