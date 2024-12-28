<?php

require_once 'autoloader.php';
use data\Dataloaderjson;
use classes\tools\render\Rendertemplates;


// $text = new Text('myinput', false, 'coucou');
// echo $text->render().PHP_EOL;

// $checkbox = new Checkbox('mycheckbox', true);
// echo $checkbox->render().PHP_EOL;

// $hidden = new Hidden('myhidden');
// echo $hidden->render().PHP_EOL;

// echo new Text('mytexttostring').PHP_EOL;

// echo new Textarea('mytextarea', true, 'default value').PHP_EOL;

$load = new Dataloaderjson('data/data.json');
$rep = $load->loader();

$render = new Rendertemplates($rep);
$render->render_questions();


// $form = [
//     [
//         'type' : 'text',
//         'name' : 'mytext',
//         'required' : false,
//     ],
//     [
//         "type" : "hidden",
//         "name" : "hiddenfield",
//         "required" : false,
//     ],
//     [
//         'type' : 'textarea',
//         'name' : 'mytextarea',
//         'required' : true,
//     ],
// ];

// foreach($form as $field) {
//     $className = ucfirst($field['type']);
//     echo new $className($field['name'], $field['required']).PHP_EOL;
// }
// die();
?>

