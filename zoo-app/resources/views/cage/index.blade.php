<x-layout>
<div class="container mx-auto py-12">
    <!-- Статистика животных -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold">В зоопарке на данный момент проживают {{ $animalsCount ?? '0' }} животных</h1>
    </div>

    <!-- Блоки клеток -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($cages as $cage)
            <a href="{{ route('cage.show', $cage->id) }}" class="block p-6 bg-white rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">
                <!-- Название клетки -->
                <div class="text-center">
                    <h2 class="text-2xl font-semibold">{{ $cage->name }}</h2>
                </div>

                <!-- Пустое пространство вокруг названия клетки -->
                <div class="my-4"></div>

                <!-- Кружки с изображениями животных -->
                <div class="flex justify-center space-x-3">
                    @foreach($cage->animals as $animal)
                        <img src="{{ asset('storage/animal_images/' . $animal->image) }}" alt="{{ $animal->name }}" class="w-12 h-12 rounded-full object-cover">
                    @endforeach
                </div>
            </a>
        @endforeach
    </div>
    <!-- Пагинация -->
    <div class="mt-8">
        {{ $cages->links() }}
    </div>
</div>
</x-layout>
