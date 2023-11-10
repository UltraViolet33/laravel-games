<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('games.search') }}">
            @csrf
            <div>
                <x-input-label for="game" :value="__('Game')" />
                <x-text-input id="game" class="block mt-1 w-full" type="text" name="game" :value="old('game')" required autofocus />
                <x-input-error :messages="$errors->get('game')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">{{ __('Search') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>