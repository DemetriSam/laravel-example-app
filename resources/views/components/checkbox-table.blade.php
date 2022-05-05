<table class="card">
    <tr>
        <th>Выбрать</th>
        <th>Имя</th>
        <th>Описание</th>
        <th>Калорийность</th>
        <th>Белки</th>
        <th>Жиры</th>
        <th>Углеводы</th>
        <th>Клетчатка</th>
    </tr>
    @foreach ($ingredients as $ingredient)
        <tr>
            <td><input class="field" type="text" name="ingredients[{{ $ingredient->id }}]"></td>
            <td>{{ $ingredient->name }}</td>
            <td>{{ $ingredient->description }}</td>
            <td>{{ $ingredient->ccal }}</td>
            <td>{{ $ingredient->proteins }}</td>
            <td>{{ $ingredient->fats }}</td>
            <td>{{ $ingredient->carbs }}</td>
            <td>{{ $ingredient->fiber }}</td>
        </tr>
        </input>
    @endforeach
</table>
