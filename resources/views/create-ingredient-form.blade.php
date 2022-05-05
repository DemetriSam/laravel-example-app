<x-layout>
    <x-form actionname='ingredients.create.store' title='Добавить ингредиент в базу'>
        <div class="">
            <p class="label">Название ингредиента</p>
            <input class="my-1 field" type="text" name="name">
        </div>

        <div class="">
            <p class="label">Описание ингредиента</p>
            <textarea class='my-1 field ~neutral !normal' name="description"></textarea>
        </div>


        <div class="">
            <p class="label">Калорийность</p>
            <input class="my-1 field" type="text" name="ccal">
            <p class="support">Килокалорий на 100гр</p>
        </div>


        <div class="">
            <p class="label">Белки</p>
            <input class="my-1 field" type="text" name="proteins">
            <p class="support">Белков на 100гр</p>
        </div>

        <div class="">
            <p class="label">Жиры</p>
            <input class="my-1 field" type="text" name="fats">
            <p class="support">Жиров на 100гр</p>
        </div>

        <div class="">
            <p class="label">Углеводы</p>
            <input class="my-1 field" type="text" name="carbs">
            <p class="support">Углеводов на 100гр</p>
        </div>

        <div class="">
            <p class="label">Клетчатка</p>
            <input class="my-1 field" type="text" name="fiber">
            <p class="support">Клетчатки на 100гр</p>
        </div>

        <div class="">
            <p class="label">Тип ингредиента</p>
            <input class="my-1 field" type="text" name="type">
            <p class="support">Что это: орехи, хлеб, зелень и т.п.</p>
        </div>
    </x-form>
</x-layout>
