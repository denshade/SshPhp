<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Authentication
 *
 * @author lveeckha
 */
class Authentication {
    /**
     * Check if the given pwd is allowed to connect.
     * @param string $pwd
     * @return boolean
     */
    public function isAuthenticated($pwd)
    {
        if ($pwd == '' || $pwd === null) return false;
        $allowedKeys = file_get_contents(__DIR__."allowedKeys.txt");
        $allowedKeys = explode("\n", $allowedKeys);
        return in_array($pwd, $allowedKeys );
    }
}
