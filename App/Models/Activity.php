<?php

namespace App\Models;

use App\Core\Model;

class Activity extends Model
{
    protected ?int $id = null;
    protected ?int $user_id = null;
    protected ?int $movie_id = null;
    protected ?float $rating = null;

    public static function findOne(int $userId, int $movieId): Activity | null
    {
        return Activity::getAll('user_id = :userId and movie_id = :movieId', ['userId' => $userId, 'movieId' => $movieId])[0] ?? null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $activity_id): void
    {
        $this->id = $activity_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getMovieId(): ?int
    {
        return $this->movie_id;
    }

    public function setMovieId(?int $movie_id): void
    {
        $this->movie_id = $movie_id;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): void
    {
        $this->rating = $rating;
    }
}