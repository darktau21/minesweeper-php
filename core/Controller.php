<?php

namespace core;

abstract class Controller
{
    public function render($filename, $data = [])
    {
        ob_start();
        if (file_exists(APP_ROOT . '/views/' . $filename . '.php')) {
            require APP_ROOT . '/views/' . $filename . '.php';
        } else {
            require APP_ROOT . '/views/404.php';
        }
        $main_content = ob_get_clean();

        require_once APP_ROOT . '/views/layout.php';
    }

    protected function is_empty_fields($fields)
    {
        if (is_array($fields)) {
            foreach ($fields as $field) {
                if (!isset($field) || $field === '') return true;
            }
            return false;
        }

        return is_null($fields) || $fields === '';
    }
}