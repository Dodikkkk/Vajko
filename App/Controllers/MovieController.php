<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Activity;
use App\Models\Actor;
use App\Models\Movie;
use App\Models\Relation;

class MovieController extends AControllerBase
{
    public function authorize(string $action)
    {
        switch ($action) {
            case 'form':
            case 'save':
                return $this->app->getAuth()->isLogged();
            default:
                return true;
        }
    }

    public function index(): Response
    {
        $movieId = $this->request()->getValue('movieId');
        if ($movieId === null) {
            return $this->redirect($this->url('home.index'));
        }
        $movie = Movie::findById($movieId);
        if ($movie === null) {
            return $this->redirect($this->url('home.index'));
        }
        $actorIds = Relation::findAllActorsByMovieId($movieId);
        $actors = [];
        foreach ($actorIds as $actorId) {
            $actor =Actor::findOneById($actorId);
            array_push($actors, $actor);
        }
        return $this->html([
            'movie' => $movie,
            'actors' => $actors,
        ]);
    }

    public function form(): Response
    {
        $userId = $this->app->getAuth()->getLoggedUserId();
        $movieId = $this->request()->getValue('movieId');
        $errors = $this->request()->getValue('errors');
        if (Movie::findById($movieId) === null) {
            return $this->redirect($this->url('home.index'));
        }
        return $this->html([
            'post' => Activity::findOne($userId, $movieId),
            'movieId' => $movieId,
            'errors' => $errors,
        ]);
    }

    public function save(): Response
    {
        $userId = $this->app->getAuth()->getLoggedUserId();
        $movieId = $this->request()->getValue('movieId');
        $existingActivity = Activity::findOne($userId, $movieId);

        $status = $this->request()->getValue('status');
        $rating = floatval($this->request()->getValue('rating'));
        $dateText = $this->request()->getValue('dateText');
        $invalidElements = [];

        if ($movieId === null || Movie::findById($movieId) === null) {
            return $this->redirect($this->url('home.index'));
        }

        if ($dateText !== null && strlen($dateText) > 0) {
            $datum = strtotime($dateText);
            if ($datum === false || $datum > time() || strlen($dateText) != 10) {
                $invalidElements[] = 'date';
            }
        }

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

        return $this->redirect($this->url('home.index'));
    }
}