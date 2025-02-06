<?php

namespace App\Models;

use App\Core\Model;


class Relation extends Model
{
    protected ?string $actor_id;
    protected ?string $movie_id;

    static public function findAllActorsByMovieId($movieId): array | null
    {
        $cast = Relation::getAll('movie_id = :movie_id', ['movie_id' => $movieId]);
        $actor_ids = array_column($cast, 'actor_id');
        return $actor_ids;
    }

    public static function findOne(int $actorId, int $movieId): Relation | null
    {
        return Relation::getAll('actor_id = :userId and movie_id = :movieId', ['userId' => $actorId, 'movieId' => $movieId])[0] ?? null;
    }

    protected static function hasCompositePrimaryKey(): bool
    {
        return true;
    }

    public function getPK()
    {
        return $this->movie_id . '_' . $this->actor_id;
    }


    public function getActorId(): ?string
    {
        return $this->actor_id;
    }

    public function setActorId(?string $actor_id): void
    {
        $this->actor_id = $actor_id;
    }

    public function getMovieId(): ?string
    {
        return $this->movie_id;
    }

    public function setMovieId(?string $movie_id): void
    {
        $this->movie_id = $movie_id;
    }


}