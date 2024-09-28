<x-layout>
    <div class="container mx-auto py-12">
        <!-- Название животного и изображение -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold">{{ $animal->name }}</h1>
            <img src="{{ asset('storage/animal_images/' . $animal->image) }}" alt="{{ $animal->name }}" class="mx-auto mt-6 w-48 h-48 rounded-full object-cover shadow-lg">
        </div>

        <!-- Информация о животном -->
        <div class="text-center mb-8">
            <p class="text-lg text-gray-800"><span class="font-semibold">Вид:</span> {{ $animal->species }}</p>
            <p class="text-lg text-gray-800"><span class="font-semibold">Возраст:</span> {{ $animal->age }} лет</p>
            <p class="text-lg text-gray-800"><span class="font-semibold">Описание:</span> {{ $animal->description ?: 'Нет описания' }}</p>
        </div>

        <!-- Кнопки управления животным -->
        @auth
        <div class="flex justify-center space-x-4">
            <a href="{{ route('animal.edit', $animal->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Редактировать</a>

            <form action="{{ route('animal.destroy', $animal->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить это животное?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300">Удалить</button>
            </form>
        </div>
        @endauth

        <!-- Ссылка для возврата -->
        <div class="text-center mt-8">
            <a href="{{ route('cage.show', $animal->cage->id) }}" class="text-blue-500 hover:underline">Вернуться к клетке</a>
        </div>
    </div>
</x-layout>
