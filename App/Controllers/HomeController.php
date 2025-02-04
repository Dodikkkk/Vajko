<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Activity;
use http\Client\Curl\User;

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
                if ($dateText == null) { $activ->setDate(date('Y-m-d H:i:s')); }    //TODO neviem co mi vracia ten element. tipujem bool TODO solved?
                else { $activ->setDate($dateText . " 12:00:00"); }
                $activ->save();
            }
        } elseif ($status === 'Not Watched' && $existingActivity) {
            $existingActivity->delete();
        }

        return $this->redirect($this->url('index'));
    }

    /**
     * Example of an action accessible without authorization
     * @return \App\Core\Responses\ViewResponse
     */
    public function contact(): Response
    {
        return $this->html();
    }

    public function index(): Response
    {
        $movies = [
            ['movieId' => 1, 'name' => 'Fero'],
            ['movieId' => 2, 'name' => 'Jozo'],
            ['movieId' => 3, 'name' => 'Hardcore'],
            ['movieId' => 4, 'name' => 'Henry'],
        ];

        return $this->html(['movies' => $movies]);
    }

    public function movie(): Response
    {
        $movieId = $this->request()->getValue('movieId');
        return $this->html(['movieId' => $movieId]);
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
}
