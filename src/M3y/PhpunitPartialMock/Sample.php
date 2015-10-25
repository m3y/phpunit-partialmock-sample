<?php

namespace M3y\PhpunitPartialMock;

class Sample
{
    public function get()
    {
        return $this->target();
    }

    public function getWithParameter($param)
    {
        return $this->targetWithParameter($param);
    }

    protected function target()
    {
        return "original method.";
    }

    protected function targetWithParameter($param)
    {
        return "method with $param.";
    }
}
