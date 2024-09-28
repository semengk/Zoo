<x-layout>
<div class="container mx-auto py-12">
    <!-- Заголовок с названием клетки и информацией о вместимости -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold">{{ $cage->name }}</h1>
        <p class="text-lg text-gray-600">Вместимость: {{ $cage->capacity }} животных</p>
    </div>

    <!-- Описание клетки или другие данные о клетке (если требуется) -->
    <div class="mb-8">
        <p class="text-gray-800 text-center">Это клетка для животных, в которой на данный момент проживают следующие особи:</p>
    </div>

    <!-- Галерея животных в клетке -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($cage->animals as $animal)
            <div class="bg-white rounded-lg shadow-lg p-4 hover:shadow-xl transition duration-300">
                <div class="flex justify-center">
                    <img src="{{ asset('storage/animal_images/' . $animal->image) }}" alt="{{ $animal->name }}" class="w-24 h-24 rounded-full object-cover">
                </div>
                <div class="text-center mt-4">
                    <h3 class="text-xl font-semibold">{{ $animal->name }}</h3>
                    <p class="text-gray-600">{{ $animal->species }}</p>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('animal.show', $animal->id) }}" class="text-blue-500 hover:underline">Посмотреть</a>
                </div>
            </div>
        @endforeach
    </div>


    <!-- Кнопки для управления клеткой -->
    @auth
    <div class="text-center mt-8">
        <a href="{{ route('cage.edit', $cage->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Редактировать клетку</a>
        <a href="{{ route('animal.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Добавить животного</a>

        <!-- Удалить клетку, если она пустая -->
        @if ($cage->animals->isEmpty())
            <form action="{{ route('cage.destroy', $cage->id) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Вы уверены, что хотите удалить эту клетку?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">Удалить клетку</button>
            </form>
        @endif
    </div>
    @endauth
</div>
</x-layout>
