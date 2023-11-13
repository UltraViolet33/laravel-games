<x-app-layout>
    <div class="container-fluid m-5">
        <div class="row justify-content-center">
            <div class="col-6 ">
                <h1 class="text-center">{{ $game->name }}</h1>

                <img src="{{ $game->imagePath }}" alt="" width="100%">

                @if ($game->description)
                    <p>{!! $game->description !!}</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
