<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\EmptyResponse;
use App\Core\Responses\Response;
use App\Models\Activity;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\Relation;
use App\Models\User;
use App\Helpers\TMDB;

/**
 * Class HomeController
 * Example class of a controller
 * @package App\Controllers
 */
class HomeController extends AControllerBase
{
    /**
     * Authorize controller actions
     * @param $action
     * @return bool
     */
    public function authorize($action)
    {
        switch ($action) {
            case 'form':
                return $this->app->getAuth()->isLogged();

            default:
                return true;
        }
        return true;
    }

    /**
     * Example of an action (authorization needed)
     * @return \App\Core\Responses\Response|\App\Core\Responses\ViewResponse
     */
    public function profile(): Response
    {
        $posts = Activity::getAll('user_id = :userId', ['userId' => $this->app->getAuth()->getLoggedUserId()]);
        return $this->html(
            [
                'activities' => $posts,
            ]
        );
    }

    public function delete(): Response
    {
        $userId = $this->request()->getValue('id');
        $user = User::findById($userId);
        $user->delete();
        return new EmptyResponse;
    }

    public function save(): Response
    {
        $userId = $this->app->getAuth()->getLoggedUserId();
        $movieId = $this->request()->getValue('movieId');
        $existingActivity = Activity::findOne($userId, $movieId);

        $status = $this->request()->getValue('status');
        $rating = floatval($this->request()->getValue('rating'));
        $hideDateCheckbox = $this->request()->getValue('hideDateCheckbox');
        $dateText = $this->request()->getValue('dateText');
        $invalidElements = [];

        if (!in_array($status, ['Watched', 'Not Watched'])) {
            $invalidElements[] = 'status';
        }
        if ($rating < 0 || $rating > 10) {
            $invalidElements[] = 'rating';
        }

        if (sizeof($invalidElements) > 0) {
            $errors = implode(',', $invalidElements);
            return $this->redirect($this->url('form', ['movieId' => $movieId, 'errors' => $errors]));
        }

        if ($status === 'Watched') {

            if ($existingActivity) {
                $existingActivity->setRating($rating);
                if ($dateText == null) { $existingActivity->setDate(date('Y-m-d H:i:s')); }
                else { $existingActivity->setDate($dateText . " 12:00:00"); }
                $existingActivity->save();
            } else {
                $activ = new Activity();
                $activ->setUserId($userId);
                $activ->setMovieId($movieId);
                $activ->setRating($rating);
                if ($dateText == null) { $activ->setDate(date('Y-m-d H:i:s')); }
                else { $activ->setDate($dateText . " 12:00:00"); }
                $activ->save();
            }
        } elseif ($status === 'Not Watched' && $existingActivity) {
            $existingActivity->delete();
        }

        return $this->redirect($this->url('index'));
    }

    public function index(): Response
    {
        $movies = Movie::getAll();
        //$movies = array_slice($movies, 0, 69);

        return $this->html(['movies' => $movies]);
    }

    public function movie(): Response
    {
        $movieId = $this->request()->getValue('movieId');
        return $this->html(['movieId' => $movieId]);
    }

    public function controlPanel(): Response
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

    public function form(): Response
    {
        $userId = $this->app->getAuth()->getLoggedUserId();
        $movieId = $this->request()->getValue('movieId');
        $errors = $this->request()->getValue('errors');

        return $this->html([
            'post' => Activity::findOne($userId, $movieId),
            'movieId' => $movieId,
            'errors' => $errors,
        ]);
    }

    public function list(): Response
    {
        $posts = Activity::getAll('user_id = :userId', ['userId' => $this->app->getAuth()->getLoggedUserId()]);
        return $this->html(
            [
                'activities' => $posts,
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
}
