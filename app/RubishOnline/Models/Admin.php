<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 14:53
 */

namespace RubishOnline\Models;


class Admin
{
    //REF http://php.net/manual/en/function.password-hash.php

    var $username;
    var $password;

    /**
     * Admin constructor.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $options = [
            'cost' => 12,
        ];

        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT, $options);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    //TODO Change to private later

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return boolean
     */
    public function checkPassword($pass)
    {
        return password_verify($pass,$this->getPassword());
    }



}