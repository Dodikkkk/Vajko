<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\EmptyResponse;
use App\Core\Responses\Response;
use App\Helpers\TMDB;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\Relation;
use App\Models\User;

class AdminController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        return $this->app->getAuth()->getLoggedUserContext()?->getIsAdmin() == 1 ?? false;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function index(): Response
    {
        $users = User::getAll();
        $userId = $this->app->getAuth()->getLoggedUserId();
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]->getUserId() === $userId) {
                array_splice($users, $i, 1);
            }
        }
        return $this->html(
            [
                'users' => $users,
            ]
        );
    }

    public function initialDataLoad(): Response
    {
        $json = file_get_contents("public/initialLoad/output_format.json");

        $response = json_decode($json, true);

        foreach ($response as $movie) {
            $result = TMDB::getMovieById($movie['id']);
            if ($result == null) {
                return new EmptyResponse;
            }
            $film = $result['movie'];
            $film->save();
            $actors = $result['cast'];
            foreach ($actors as $actor) {
                $one = Actor::findOne($actor->getName());
                if ($one == null) {
                    $actor->save();
                    $rel = new Relation();
                    $rel->setActorId($actor->getActorId());
                    $rel->setMovieId($movie['id']);
                    $rel->save();
                } else {
                    $rel = new Relation();
                    $rel->setActorId($one->getActorId());
                    $rel->setMovieId($movie['id']);
                    $rel->save();
                }
            }
            usleep(21000);
        }
        return new EmptyResponse;
    }

    public function changeAdminStatus(): Response
    {
        $userId = $this->request()->getValue('id');
        if ($userId === null || $userId === $this->app->getAuth()->getLoggedUserId()) {
            return new EmptyResponse;
        }
        $user = User::findById($userId);
        if ($user == null) {
            return new EmptyResponse;
        }
        if ($user->getIsAdmin() == 1) {
            $user->setIsAdmin(0);
        } else {
            $user->setIsAdmin(1);
        }
        $user->save();
        return new EmptyResponse;
    }

    public function updateStats(): Response
    {
        $ids = TMDB::getUpdatedData();
        foreach ($ids as $id) {
            $result = TMDB::getMovieById($id);
            if ($result == null) {
                return new EmptyResponse;
            }
            $film = $result['movie'];
            $existingMovie = Movie::findById($id);
            if ($existingMovie == null) {
                $film->save();
            } else {
                $existingMovie->setTitle($film->getTitle());
                $existingMovie->setSynopsis($film->getSynopsis());
                $existingMovie->setRating($film->getRating());
                $existingMovie->setImage($film->getImage());
                $existingMovie->setRuntime($film->getRuntime());
                $existingMovie->setReleaseDate($film->getReleaseDate());
                $existingMovie->setGenres($film->getGenres());
                $existingMovie->setdirector($film->getDirector());
                $existingMovie->setTrailer($film->getTrailer());
                $existingMovie->save();
            }
            $actors = $result['cast'];
            foreach ($actors as $actor) {
                $one = Actor::findOne($actor->getName());
                if ($one == null) {
                    $actor->save();
                    if (Relation::findOne($actor->getActorId(), $id) == null) {
                        $rel = new Relation();
                        $rel->setActorId($actor->getActorId());
                        $rel->setMovieId($id);
                        $rel->save();
                    }
                } else {
                    if (Relation::findOne($one->getActorId(), $id) == null) {
                        $rel = new Relation();
                        $rel->setActorId($one->getActorId());
                        $rel->setMovieId($id);
                        $rel->save();
                    }
                }
            }
            usleep(21000);
        }

        return new EmptyResponse;
    }

    public function delete(): Response
    {
        $userId = $this->request()->getValue('id');
        if ($userId === null || $userId === $this->app->getAuth()->getLoggedUserId()) {
            return new EmptyResponse;
        }
        $user = User::findById($userId);
        if ($user == null) {
            return new EmptyResponse;
        }
        $user->delete();
        return new EmptyResponse;
    }
}
