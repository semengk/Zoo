<x-layout>
    <div class="container mx-auto py-12">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-center mb-6">Редактировать животное</h1>

            <form action="{{ route('animal.update', $animal->id) }}" method='POST' enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <!-- Имя животного -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Имя</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $animal->name ?? '') }}" class="w-full p-2 border rounded-lg @error('name') border-red-500 @enderror" required>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Вид животного -->
                <div class="mb-4">
                    <label for="species" class="block text-gray-700">Вид</label>
                    <input type="text" name="species" id="species" value="{{ old('species', $animal->species ?? '') }}" class="w-full p-2 border rounded-lg @error('species') border-red-500 @enderror" required>
                    @error('species')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Возраст животного -->
                <div class="mb-4">
                    <label for="age" class="block text-gray-700">Возраст</label>
                    <input type="number" name="age" id="age" value="{{ old('age', $animal->age ?? '') }}" class="w-full p-2 border rounded-lg @error('age') border-red-500 @enderror" required>
                    @error('age')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Описание животного -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Описание</label>
                    <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded-lg @error('description') border-red-500 @enderror">{{ old('description', $animal->description ?? '') }}</textarea>
                    @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>



                <!-- Фото животного -->
                <div class="mb-4">
                    <label for="photo" class="block text-gray-700">Фото</label>
                    <input type="file" name="image" id="photo" class="w-full p-2 border rounded-lg @error('image') border-red-500 @enderror">
                    @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Кнопки -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        {{ isset($animal) ? 'Сохранить изменения' : 'Добавить животное' }}
                    </button>
                    <a href="{{ route('animal.index') }}" class="ml-4 text-gray-500 hover:underline">Отмена</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
