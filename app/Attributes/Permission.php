<?php

namespace App\Attributes;

#[\Attribute]
class Permission
{
    public string $permission;

    public function __construct($permission)
    {
        $this->permission = $permission;
    }

}
