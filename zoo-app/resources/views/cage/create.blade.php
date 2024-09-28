<x-layout/>
<div class="container mx-auto py-12">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center mb-6">{{ isset($cage) ? 'Редактировать клетку' : 'Добавить клетку' }}</h1>

        <form action="{{ route('cage.store') }}" method="POST">
            @csrf

            <!-- Название клетки -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Название клетки</label>
                <input type="text" name="name" id="name" value="{{ old('name', $cage->name ?? '') }}" class="w-full p-2 border rounded-lg @error('name') border-red-500 @enderror" required>
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Вместимость клетки -->
            <div class="mb-4">
                <label for="capacity" class="block text-gray-700">Вместимость</label>
                <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $cage->capacity ?? '') }}" class="w-full p-2 border rounded-lg @error('capacity') border-red-500 @enderror" required>
                @error('capacity')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Кнопки -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                    {{ isset($cage) ? 'Сохранить изменения' : 'Добавить клетку' }}
                </button>
                <a href="{{ route('cage.index') }}" class="ml-4 text-gray-500 hover:underline">Отмена</a>
            </div>
        </form>
    </div>
</div>
<x-layout/>
