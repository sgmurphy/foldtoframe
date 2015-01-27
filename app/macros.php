<?php
/*
|--------------------------------------------------------------------------
| Delete form macro
|--------------------------------------------------------------------------
|
| This macro creates a form with only a submit button.
| We'll use it to generate forms that will post to a certain url with
| the DELETE method, following REST principles.
|
*/
Form::macro('delete', function ($url, $label = 'Delete', $formAttrs = array(), $buttonAttrs = array()) {
    $formAttrs = array_merge(array(
        'method' => 'DELETE',
        'class'  => 'delete-form',
        'url'    => $url
    ), $formAttrs);

    return Form::open($formAttrs) . Form::submit($label, $buttonAttrs) . Form::close();
});