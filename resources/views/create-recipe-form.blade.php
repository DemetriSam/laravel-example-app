<x-layout title="Добавить рецепт в базу">
    <x-form actionname="recipes.create.store" title="Добавить рецепт в базу">
        <div class="">
            <p class="label">Название рецепта</p>
            <input class="my-1 field" type="text" name="name">
        </div>

        <div class="">
            <p class="label">Описание рецепта</p>
            <textarea class='my-1 field ~neutral !normal' name="description"></textarea>
        </div>
        <div class="">
            <p class="label">Тип рецепта</p>
            <input class="my-1 field" type="text" name="type" value="test">
        </div>
        <x-checkbox-table :ingredients="$ingredients" />
    </x-form>
</x-layout>
