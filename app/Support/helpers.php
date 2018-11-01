<?php


if (!function_exists('debug')) {
    /**
     * Something like x but way better ;)
     *
     * @param  mixed
     * @return void
     */
    function debug($value)
    {
        $fp = fopen('/tmp/mms.log', 'a');
        if (is_string($value)) {
            fwrite($fp, $value."\n");
        } else {
            fwrite($fp, print_r($value, true));
        }
        fclose($fp);
    }
}
