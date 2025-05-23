<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Recipe
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('recipes.update', $recipe) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="recipe_name">Recipe Name: </label>
                            <input type="text" name="recipe_name" id="recipe_name" value="{{ $recipe->recipe_name }}"
                                class="w-full border-gray-300 rounded" required>
                            @error('recipe_name')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="instructions">Instructions: </label>
                            <textarea name="instructions" id="instructions" class="w-full border-gray-300 rounded"
                                rows="6" required>{{ $recipe->instructions }}</textarea>
                            @error('instructions')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prep_time">Prepare Time: (mins)</label>
                            <input type="number" name="prep_time" id="prep_time" value="{{ $recipe->prep_time }}"
                                class="w-full border-gray-300 rounded" required>
                            @error('prep_time')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="servings">Servings: (people)</label>
                            <input type="number" name="servings" id="servings" value="{{ $recipe->servings }}"
                                class="w-full border-gray-300 rounded" required>
                            @error('servings')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="photo">Photo: (optional)</label>
                            @if ($recipe->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $recipe->photo) }}" alt="Current recipe photo"
                                        class="w-48">
                                    <p class="text-sm text-gray-600">Current photo</p>
                                </div>
                            @endif
                            <input type="file" name="photo" id="photo" class="w-full border-gray-300 rounded">
                            <p class="text-sm text-gray-600">Leave empty to keep current photo</p>
                            @error('photo')
                                <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4" id="ingredients-container">
                            <label>Ingredients:</label>
                            @foreach($recipe->ingredients as $index => $ingredient)
                                <div class="ingredient-row flex space-x-4 mb-2">
                                    <input type="text" name="ingredients[{{ $index }}][name]"
                                        value="{{ $ingredient->ingredient_name }}" placeholder="Ingredient Name"
                                        class="w-1/2 border-gray-300 rounded" required>
                                    <input type="text" name="ingredients[{{ $index }}][quantity]"
                                        value="{{ $ingredient->quantity }}" placeholder="Quantity"
                                        class="w-1/2 border-gray-300 rounded" required>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" onclick="addIngredientRow()"
                            class="mb-4 bg-gray-500 text-white px-4 py-2 rounded">
                            Add another ingredient
                        </button>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Update Recipe
                            </button>
                            <a href="{{ route('recipes.my') }}" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let ingredientIndex = {{ count($recipe->ingredients) }};

        function addIngredientRow() {
            const container = document.getElementById('ingredients-container');
            const newRow = document.createElement('div');
            newRow.className = 'ingredient-row flex space-x-4 mb-2';

            newRow.innerHTML = `
                <input type="text" name="ingredients[${ingredientIndex}][name]" placeholder="Ingredient Name" class="w-1/2 border-gray-300 rounded" required>
                <input type="text" name="ingredients[${ingredientIndex}][quantity]" placeholder="Quantity" class="w-1/2 border-gray-300 rounded" required>
            `;

            container.appendChild(newRow);
            ingredientIndex++;
        }
    </script>
</x-app-layout>