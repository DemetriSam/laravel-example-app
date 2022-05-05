@php
$title = 'Пересчитать количество ингредиентов в рецепте';
//dd($recipe_name);
@endphp
<x-layout title="{{ $title }}">
    <x-form actionname="recipes.update" title="{{ $title }}">
        <x-table :recipe="$recipe" quantityInput="1" :recipeName="$recipe_name" />
        <p><input name="recipe_id" value="{{ $recipe_id }}" class="hidden" /></p>
        <input name="recipe_name" value="{{ $recipe_name }}" class="hidden" />
    </x-form>
</x-layout>
