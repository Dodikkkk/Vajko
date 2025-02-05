<?php

namespace App\Models;

use App\Core\Model;


class Relation extends Model
{
    protected ?int $id;
    protected ?string $actor_id;
    protected ?string $movie_id;

    static public function findAllActorsByMovieId($movieId): array | null
    {
        $cast = Relation::getAll('movie_id = :id', ['id' => $movieId]);
        $actor_ids = array_column($cast, 'actor_id'); //TODO dufam ze je to spravne
        return $actor_ids;
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