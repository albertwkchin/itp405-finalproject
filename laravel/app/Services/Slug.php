<?php

namespace App\Services;

class Slug {

    protected $slug;

    public function __construct($str)
    {
        $this->slug = strtolower(implode('-', explode(' ', $str)));
    }

    public function __toString()
    {
        return $this->slug;
    }

}