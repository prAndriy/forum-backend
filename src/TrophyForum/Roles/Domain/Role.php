<?php

declare(strict_types = 1);

namespace TrophyForum\Roles\Domain;

use TrophyForum\Authors\Domain\Author;

class Role
{
    private $id;
    private $name;
    private $author;

    public function __construct(RoleId $id, RoleName $name, Author $author)
    {
        $this->id     = $id;
        $this->name   = $name;
        $this->author = $author;
    }

    public function id(): RoleId
    {
        return $this->id;
    }

    public function name(): RoleName
    {
        return $this->name;
    }

    public function author(): Author
    {
        return $this->author;
    }
}
