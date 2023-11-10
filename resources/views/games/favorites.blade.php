<x-app-layout>
    <h1 class="text-center">Mes jeux</h1>
    <div class="container-fluid m-5">
        <div class="row justify-content-center">
            @if (count($games) > 0)
                <div class="row">
                    @foreach ($games as $game)
                        <div class="col-3 my-2">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ $game->imagePath }}" class="card-img-top" alt="..."
                                    style="width:100%;height:200px;object-fit:cover">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $game->name }}</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <a href="/games/remove/{{ $game->id }}" class="btn btn-primary">Remove</a>
                                    <a href="" class="btn btn-primary">See details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
