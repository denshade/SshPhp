<?php

/**
 * This captures all the Console commands.
 * User: Lieven
 * Date: 5-6-2017
 * Time: 21:02
 */
class Console
{
    public static function registerOutput($output)
    {
        file_put_contents(self::getLogFile(), $output . "\n", FILE_APPEND);
    }
    public static function getLogFile()
    {
        $dirn = dirname(__FILE__); 
        return $dirn . DIRECTORY_SEPARATOR . "logs";
    }
    public static function getOutput()
    {
        if (!file_exists(self::getLogFile()))
            return "";
        return file_get_contents(self::getLogFile());
    }
}