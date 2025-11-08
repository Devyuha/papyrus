<?php

namespace Papyrus\Ui;

use Exception;
use Papyrus\Ui\View;

class Template
{
    private $path;
    private $args;
    private $module;
    private array $componentStack = [];

    public function __construct(string $path, array $args = [])
    {
        $this->path = $path;
        $this->args = $args;
    }

    public function module($module = "Main")
    {
        $this->module = $module;
        return $this;
    }

    public function render()
    {
        $viewPath = $this->getPath($this->path, $this->module);

        if (!file_exists($viewPath)) {
            throw new Exception("View file not found :: " . $viewPath);
        }

        $this->args["template"] = new View($this);
        $args = $this->args;

        ob_start();

        (function () use ($viewPath, $args) {
            extract($args);
            include $viewPath;
        })();

        return ob_get_clean();
    }

    public function includes(string $path, array|null $args = null, ?string $module = null)
    {
        $module = $module ?? $this->module;
        $viewPath = $this->getPath($path, $module);

        if (!file_exists($viewPath)) {
            throw new Exception("Include file not found :: " . $viewPath);
        }
        $args = $args ?? [];
        $args["template"] = $this->args["template"];

        (function () use ($viewPath, $args) {
            extract($args);
            include $viewPath;
        })();
    }

    public function component(string $component, array|null $props = null, ?string $module = null): void {
        ob_start();
        $this->componentStack[] = [
            "component" => $component,
            "props" => $props,
            "module" => $module
        ];
    }

    public function endComponent(): void {
        $content = ob_get_clean();
        $current = array_pop($this->componentStack);

        $this->render(
            $current["component"],
            $current["props"],
            $content,
            $current["module"]
        );
    }

    public function renderComponent(string $component, array $props, string $slot, ?string $module = null): void {
        $path = $this->getPath($component, $module);

        (function () use ($path, $props) {
            extract($props);
            include $path;
        })();
    }

    private function getPath($path, $module)
    {
        $viewPath = base_path("modules/" . $module . "/views/" . $path . ".php");

        return $viewPath;
    }
}
