<?php

namespace Siakad\Scheduling\Application;

use Siakad\Scheduling\Domain\Response\MessageResponse;

class MelihatPrasaranaResponse
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
}