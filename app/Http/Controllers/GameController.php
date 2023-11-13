<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class GameController extends Controller
{

    public function index(Request $request): View
    {
        $games = [];

        if ($request->isMethod("post")) {
            $gameSearch = $request->validate([
                'search' => 'required|string|max:255',
            ]);

            $games = $this->searchGame($gameSearch["search"]);
        }

        return view('games.index', ['games' => $games]);
    }


    public function removeFavoritesGame(int $id, Request $request)
    {
        $game = Game::find($id);
        $request->user()->games()->detach($game);
        return redirect('/games/favorites');
    }

    public function addFavorite(int $id, Request $request)
    {
        // check if the game if already in the db
        $game = Game::where("idAPIRawg", $id)->first();

        // dd($game->id);

        if ($game) {
            foreach (Auth::user()->games as $gameUser) {
               
                if ($gameUser->id == $game->id) {
                    return redirect('/games/favorites');
                }
            }
        }


        if (!$game) {
            $gameDetails =  $this->getDetailsGame($id);
            $game = new Game();
            $game->name = $gameDetails->name;
            $game->imagePath = $gameDetails->background_image;
            $game->description = $gameDetails->description;
            $game->idAPIRawg = $gameDetails->id;
            $game->save();
        }

        $request->user()->games()->attach($game->id);
        return redirect('/games/favorites');
    }


    public function displayFavoriteGames(Request $request)
    {
        $games = $request->user()->games;
        return view('games.favorites', ['games' => $games]);
    }


    public function displayDetails(int $id)
    {
        $game = Game::where("id", $id)->first();

        if (!$game) {
            $gameDetails = $this->getDetailsGame($id);
            $game = new Game();
            $game->name = $gameDetails->name;
            $game->imagePath = $gameDetails->background_image;
            $game->description = $gameDetails->description;
            $game->idAPIRawg = $gameDetails->id;
            $game->save();
        }

        return view('games.details', ['game' => $game]);
    }


    public function getDetailsGame(int $id)
    {
        $key = env("API_RAWG_KEY");
        $apiUrl = env("API_URL");

        $url = "$apiUrl/games/$id?key=$key";
        $response = Http::get($url);

        return $response->object();
    }


    public function searchGame(string $gameSearch): array
    {
        $key = env("API_RAWG_KEY");
        $apiUrl = env("API_URL");

        $url = "$apiUrl/games?key=$key&search=$gameSearch";
        $response = Http::get($url);

        return $response->object()->results;
    }
}
