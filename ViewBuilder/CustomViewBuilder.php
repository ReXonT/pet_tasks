<?php

namespace Merexo;

class CustomViewBuilder extends ViewBuilder
{
    public function __construct($component, $dir = "Components", $part = "")
    {
        /*
         * Example fs for this realization:
         * src
         * ...
         * - Parts
         * ...
         * - - Users
         * ...
         * - - - Views
         * - - - - Components
         * ...
         * - - Projects
         * ...
         * - - - Views
         * - - - - Components
         */
        $root_resource_dir = $_SERVER['DOCUMENT_ROOT']."/src/";
        $path_to_part = $part ? "Parts/{$part}/" : "";

        parent::__construct($component, $dir, $root_resource_dir.$path_to_part.'Views');
    }
}