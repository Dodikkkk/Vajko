<?php

namespace App\Models;

use App\Core\Model;


class User extends Model
{
    protected ?int $user_id = null;
    protected ?string $name = null;
    protected ?string $password = null;

    public static function getPkColumnName(): string
    {
        return "user_id";
    }

    protected int $is_admin = 0;

    static public function findByName(string $login): ?User
    {
        return User::getAll('name = :login', ['login' => $login])[0] ?? null;
    }

    static public function findById(int $id): ?User
    {
        return User::getAll('user_id = :id', ['id' => $id])[0] ?? null;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getIsAdmin(): ?int
    {
        return $this->is_admin;
    }

    public function setIsAdmin(?int $is_admin): void
    {
        $this->is_admin = $is_admin;
    }
}