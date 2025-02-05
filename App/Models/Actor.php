<?php

namespace App\Models;

use App\Core\Model;


class Actor extends Model
{
    protected ?int $actor_id;
    protected ?string $name;
    protected ?string $image;

    public static function findOne(string $name): Actor | null
    {
        return Actor::getAll('name = :name', ['name' => $name])[0] ?? null;
    }

    public static function findOneById(string $name): Actor | null
    {
        return Actor::getAll('actor_id = :name', ['name' => $name])[0] ?? null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getActorId(): ?int
    {
        return $this->actor_id;
    }

    public static function getPkColumnName(): string
    {
        return 'actor_id';
    }

    public function setActorId(?int $actor_id): void
    {
        $this->actor_id = $actor_id;
    }


}