<?php

namespace Merexo;

class ViewBuilder
{
    protected $component;
    protected $dir;
    protected $part;
    protected $data;

    /**
     * @var ViewBuilder[]
     */
    protected $children = [];

    public function __construct($component, $dir = "", $part = "")
    {
        $this->component = $component;
        $this->dir = rtrim($dir, '/');
        $this->part = $part;
    }

    public function setId($id)
    {
        $this->data['id'] = $id;
    }

    public function setClassesStr($classes)
    {
        $this->data['class'] = $classes;
    }

    public function setToData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function setData(array $data)
    {
        if (is_array($this->data)) {
            $this->data = array_merge($this->data, $data);
        } else {
            $this->data = $data;
        }
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function getFromData($key)
    {
        return $this->data[$key];
    }

    public function render()
    {
        $file_path = $this->createComponentFilePath();

        ob_start();
        if (file_exists($file_path)) {
            include $file_path;
        } else {
            die("template not found in $file_path");
        }

        return ob_get_clean();
    }

    public function includeChild(ViewBuilder $component)
    {
        $this->children[] = $component;
    }

    public function renderChildren()
    {
        if (count($this->children) > 0) {
            foreach ($this->children as $child) {
                echo $child->render();
            }
        }
    }

    private function createComponentFilePath(): string
    {
        $path_to_part = $this->part;
        $dir = $this->dir ? $this->dir . "/" : "";

        $path_to_component = "{$path_to_part}/{$dir}";

        return $path_to_component.$this->component.".php";
    }
}