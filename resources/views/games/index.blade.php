<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('games.index') }}">
            @csrf
            <div>
                <x-input-label for="search" :value="__('Game')" />
                <x-text-input id="search" class="block mt-1 w-full" type="text" name="search" :value="old('search')"
                    required autofocus />
                <x-input-error :messages="$errors->get('search')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">{{ __('Search') }}</x-primary-button>
        </form>
    </div>
    <div class="container-fluid m-5">
        <div class="row justify-content-center">
            @if (count($games) > 0)
                <div class="row">
                    @foreach ($games as $game)
                        <div class="col-3 my-2">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ $game->background_image }}" class="card-img-top" alt="..."
                                    style="width:100%;height:200px;object-fit:cover">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $game->name }}</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <a href="" class="btn btn-primary">Add Favorite</a>
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
