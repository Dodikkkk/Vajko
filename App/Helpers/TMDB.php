<?php
namespace App\Helpers;

use App\Models\Actor;
use App\Models\Movie;
use App\Config\Configuration;

class TMDB {
    static public function getMovieById($movieId) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.themoviedb.org/3/movie/" . $movieId . "?language=en-US&append_to_response=credits,images,videos",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
            "Authorization: Bearer " . Configuration::TMDB_TOKEN,
                "accept: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return null;
        }

        $response = json_decode($response, true);

        $movie = new Movie();
        $movie->setId($response['id']);
        $movie->setTitle($response["original_title"]);
        $movie->setSynopsis($response["overview"]);
        $movie->setImage("https://media.themoviedb.org/t/p/w300_and_h450_bestv2" . $response["poster_path"]);
        $movie->setReleaseDate($response["release_date"]);
        $movie->setRating($response["vote_average"]);
        $movie->setRuntime($response["runtime"]);
        $movie->setGenres("");
        for ($i = 0; $i < count($response["genres"]); $i++) {
            $movie->setGenres($movie->getGenres() . $response["genres"][$i]["name"]);
            if ($i < count($response["genres"]) - 1) {
                $movie->setGenres($movie->getGenres() . " | ");
            }
        }
        $movie->setDirector("");
        for ($i = 0; $i < count($response["credits"]["crew"]); $i++) {
            if ($response["credits"]["crew"][$i]["job"] == "Director") {
                $movie->setDirector($response["credits"]["cast"][$i]["name"]);
            }
        }
        $movie->setTrailer("");
        for ($i = 0; $i < count($response["videos"]["results"]); $i++) {
            if ($response["videos"]["results"][$i]["site"] == "YouTube" && $response["videos"]["results"][$i]["name"] == "Official Trailer") {
                $movie->setTrailer("https://www.youtube.com/watch?v=" . $response["videos"]["results"][$i]["key"]);
            }
        }

        $cast = [];
        if (count($response["credits"]["cast"]) > 8) {
            for ($i = 0; $i < 8; $i++) {
                $act = new Actor();
                $act->setName($response["credits"]["cast"][$i]["name"]);
                $act->setImage("https://media.themoviedb.org/t/p/w300_and_h450_bestv2" . $response["credits"]["cast"][$i]["profile_path"]);
                array_push($cast, $act);
            }
        } else {
            for ($i = 0; $i < count($response["credits"]["cast"]); $i++) {
                $act = new Actor();
                $act->setName($response["credits"]["cast"][$i]["name"]);
                $act->setImage("https://media.themoviedb.org/t/p/w300_and_h450_bestv2" . $response["credits"]["cast"][$i]["profile_path"]);
                array_push($cast, $act);
            }
        }

        return [
            "movie" => $movie,
            "cast" => $cast
        ];
    }
}