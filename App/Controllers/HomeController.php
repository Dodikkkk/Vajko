<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Activity;
use App\Models\Movie;
use App\Models\MovieOrder;

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
            case 'list':
            case 'profile':
                return $this->app->getAuth()->isLogged();
            default:
                return true;
        }
    }

    public function index(): Response
    {
        $year = $this->request()->getValue('year');
        $search = $this->request()->getValue('search') ?? "";
        if ($year != null && intval($year) != 0) {
            $year = intval($year);
        } else {
            $year = null;
        }
        $order = $this->request()->getValue('order');
        if ($order != null && intval($order) > 0 && intval($order) < 6) {
            $order = MovieOrder::from(intval($order));
        } else {
            $order = null;
        }
        $movies = Movie::search($search, $year, $order);

        return $this->html(['movies' => $movies]);
    }

    public function list(): Response
    {
        $posts = Activity::getAll('user_id = :userId', ['userId' => $this->app->getAuth()->getLoggedUserId()]);
        $movies = [];
        foreach ($posts as $post) {
            array_push($movies, Movie::findById($post->getMovieId()));
        }
        return $this->html(
            [
                'activities' => $posts,
                'movies' => $movies,
            ]
        );
    }

    public function profile(): Response
    {
        $posts = Activity::getAll('user_id = :userId', ['userId' => $this->app->getAuth()->getLoggedUserId()], orderBy: "date desc");
        $movies = [];
        foreach ($posts as $post) {
            array_push($movies, Movie::findById($post->getMovieId()));
        }
        $days = 0;
        $count = 0;
        $sum = 0;
        foreach ($movies as $post) {
            $days = $days + $post->getRuntime();
        }
        foreach ($posts as $post) {
            if ($post->getRating() != 0) {$count++; $sum += $post->getRating();}
        }

        if (count($posts) < 11) {
            $start = 0;
            $mid = 5;
            $end = 10;
        } else if (count($posts) < 26) {
            $start = 10;
            $mid = 17.5;
            $end = 25;
        } else if (count($posts) < 101) {
            $start = 25;
            $mid = 62.5;
            $end = 100;
        } else if (count($posts) < 251) {
            $start = 100;
            $mid = 175;
            $end = 250;
        } else {
            $start = 250;
            $mid = 625;
            $end = 1000;
        }

        $ratio = (count($posts) - $start) / ($end - $start) * 100;
        return $this->html(
            [
                'activities' => $posts,
                'movies' => $movies,
                'daysWatched' => round( $days / 1440, 1),
                'mean' => $count > 0 ? round( $sum / $count, 2) : 0,
                'start' => $start,
                'end' => $end,
                'mid' => $mid,
                'ratio' => $ratio,
            ]
        );
    }
}