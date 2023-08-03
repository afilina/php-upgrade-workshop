<?php
if (!function_exists('format_price')) {
    function format_price($price)
    {
        return '$' . number_format($price, 2, '.');
    }
}

function is_form_submitted()
{
    global $_POST;
    return count($_POST) > 0;
}

function get_form_values($initial_data)
{
    global $_POST;
    while (list($k, $v) = Adapter53::each($initial_data)) {
        if (isset($_POST[$k])) {
            $initial_data->$k = $_POST[$k];
        }
    }
    return $initial_data;
}

function validate($data, $validation)
{
    global $errors;
    reset($data);
    $is_valid = true;
    while (list($k, $v) = Adapter53::each($data)) {
        if (isset($validation[$k])) {
            while (list($k2, $v2) = Adapter53::each($validation[$k])) {
                if ($message = call_user_func('validate_' . $k2, $k2, $v, $v2)) {
                    $errors[] = $message;
                    $is_valid = false;
                }
            }
        }
    }
    return $is_valid;
}

function show_form_errors()
{
    global $errors;
    echo '<ul class="errors">';
    while (list($k, $v) = Adapter53::each($errors)) {
        echo '<li>'.$v.'</li>';
    }
    echo '</ul>';
}

function validate_notempty($field, $data, $flag)
{
    if ($flag && strlen(trim($data)) == 0) {
        return '"' . $field . '" cannot be empty';
    }
    return false;
}

function validate_length($field, $data, $options)
{
    if (isset($options['min']) && strlen($data) < $options['min']) {
        return '"' . $field . '" must be at least ' . $options['min'] . ' characters';
    }
    if (isset($options['max']) && strlen($data) > $options['max']) {
        return '"' . $field . '" must be at least ' . $options['max'] . ' characters';
    }
    return false;
}

?>
