<x-layout>
<div class="container mx-auto py-12">
    <h1 class="text-3xl font-bold text-center mb-8">Все животные</h1>

    <!-- Сетка животных -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach ($animals as $animal)
            <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
                <!-- Фото животного -->
                <img src="{{ asset('storage/animal_images/' . $animal->image) }}" alt="{{ $animal->name }}" class="w-32 h-32 rounded-full object-cover mb-4">

                <!-- Имя и вид животного -->
                <h2 class="text-xl font-semibold text-gray-800">{{ $animal->name }}</h2>
                <p class="text-gray-500">{{ $animal->species }}</p>

                <!-- Действия с животным -->
                <div class="mt-4 flex space-x-4">
                    <!-- Иконка просмотра -->
                    <a href="{{ route('animal.show', $animal->id) }}" class="text-blue-500 hover:text-blue-600" title="Просмотр">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12m0 0a3 3 0 11-6 0 3 3 0 016 0zM12 21a9 9 0 100-18 9 9 0 000 18z" />
                        </svg>
                    </a>
                    @auth
                    <!-- Иконка редактирования -->
                    <a href="{{ route('animal.edit', $animal->id) }}" class="text-yellow-500 hover:text-yellow-600" title="Редактировать">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17.5V21H3v-8h3.5M18.086 2.914a2.5 2.5 0 113.536 3.536l-9.793 9.793-4 1 1-4 9.793-9.793z" />
                        </svg>
                    </a>

                    <!-- Иконка удаления -->
                    <form action="{{ route('animal.destroy', $animal->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить это животное?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600" title="Удалить">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-6 4h6M5 7h14l-1 13H6L5 7zm5-4h4l1 4H9l1-4z" />
                            </svg>
                        </button>
                    </form>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

    <!-- Пагинация -->
    <div class="mt-8">
        {{ $animals->links() }}
    </div>
</div>
</x-layout>
