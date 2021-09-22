<?php

/*
 * Use example
 *
 * Print Modal with form
 */

$modal = new \Merexo\CustomViewBuilder('modal');

$form = new \Merexo\CustomViewBuilder('form');
$form->setToData('my_custom_data', 'some_value');

$modal->includeChild($form);

echo $modal->render();