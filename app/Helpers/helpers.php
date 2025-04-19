<?php
if (!function_exists('_pr')) {
    function _pr($data = [], $flag = 1)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if ($flag == 1) {
            exit;
        }   
    }
}
