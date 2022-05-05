<table>
    <tr>
        <td>Имя</td>
        <td>Описание</td>
        <td>Калорийность</td>
        <td>Белки</td>
        <td>Жиры</td>
        <td>Углеводы</td>
        <td>Клетчатка</td>
    </tr>
    @foreach ($ingredients as $ingredient)
        <tr ingredient-id="{{ $ingredient->id }}">
            <td>
                <a href="{{ route('ingredients.show', ['ingredient' => $ingredient->id]) }}">
                    {{ $ingredient->name }}
                </a>
            </td>
            <td>{{ $ingredient->description }}</td>
            <td>{{ $ingredient->ccal }}</td>
            <td>{{ $ingredient->proteins }}</td>
            <td>{{ $ingredient->fats }}</td>
            <td>{{ $ingredient->carbs }}</td>
            <td>{{ $ingredient->fiber }}</td>
        </tr>
    @endforeach
</table>
