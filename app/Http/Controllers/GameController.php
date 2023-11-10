<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $gameDetails =  $this->getDetailsGame($id);

        $newGame = new Game();

        $newGame->name = $gameDetails->name;

        $newGame->imagePath = $gameDetails->background_image;
        $newGame->description = $gameDetails->description;

        $newGame->save();

        $request->user()->games()->attach($newGame->id);

        return redirect('/games/favorites');
    }


    public function displayFavoriteGames(Request $request)
    {
        $games = $request->user()->games;

        return view('games.favorites', ['games' => $games]);
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
