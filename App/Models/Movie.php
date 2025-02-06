<?php

namespace App\Models;

use App\Core\Model;


class Movie extends Model
{
    protected ?int $id;
    protected ?string $title;
    protected ?string $synopsis;
    protected ?string $release_date;
    protected ?string $genres;
    protected ?float $rating;
    protected ?string $image;
    protected ?int $runtime;
    protected ?string $director;
    protected ?string $trailer;

    static public function findById(int $id): ?Movie
    {
        return Movie::getAll('id = :id', ['id' => $id])[0] ?? null;
    }

    static public function search(string $title, ?int $year, ?MovieOrder $order): array
    {
        $title = str_replace('%', '\\%', $title);
        $title = str_replace('_', '\\_', $title);
        $title = strtolower($title);
        return Movie::getAll("lower(title) like concat('%',:title,'%') and (:year is null or (release_date is not null and :year = cast( substring(release_date, 1, 4) as integer)))", ['title' => $title, 'year' => $year], orderBy: $order?->getOrder(), limit: 420);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): void
    {
        $this->synopsis = $synopsis;
    }

    public function getReleaseDate(): ?string
    {
        return $this->release_date;
    }

    public function setReleaseDate(?string $release_date): void
    {
        $this->release_date = $release_date;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function setGenres(?string $genres): void
    {
        $this->genres = $genres;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): void
    {
        $this->rating = $rating;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function setRuntime(?int $runtime): void
    {
        $this->runtime = $runtime;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): void
    {
        $this->director = $director;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(?string $trailer): void
    {
        $this->trailer = $trailer;
    }


}