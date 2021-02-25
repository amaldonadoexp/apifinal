<?php

namespace App\Helpers;

use Firebase\JWT\JWT;

class Token
{
    private $key;
    private $data;
    private $algorithm;

    public function __construct($data = null)
    {
        $this->key = "`qo3ieh4gnopiewh89wnrti9ugnfiopearjsfp982857yuiotugweng4iuwo5";
        $this->algorithm = array('HS256');
        $this->data = $data;
    }

    public function encode()
    {
        return JWT::encode($this->data, $this->key);
    }

    public function decode($token)
    {
        return JWT::decode($token, $this->key, $this->algorithm);
    }
}
