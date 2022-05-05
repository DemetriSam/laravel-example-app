@php
$table_order = ['name', 'ccal/100gr', 'proteins/100gr', 'fats/100gr', 'carbs/100gr', 'fiber/100gr', 'quantity', 'ccal', 'proteins', 'fats', 'carbs', 'fiber'];
$dict = [
    'name' => 'Название ингредиента',
    'ccal/100gr' => 'Калорийность на 100 грамм',
    'proteins/100gr' => 'Белков на 100 грамм',
    'fats/100gr' => 'Жиров на 100 грамм',
    'carbs/100gr' => 'Углеводов на 100 грамм',
    'fiber/100gr' => 'Клетчатки на 100 грамм',
    'quantity' => 'Количество',
    'ccal' => 'Калорий',
    'proteins' => 'Белков',
    'fats' => 'Жиров',
    'carbs' => 'Углеводов',
    'fiber' => 'Клетчатки',
];
@endphp

<h1>
    {{ $recipeName }}</h1>
<table class="card">
    <tr>
        @foreach ($table_order as $field)
            <th>
                {{ $dict[$field] }}
            </th>
        @endforeach
    </tr>
    @foreach ($recipe as $component)
        <tr>
            @foreach ($table_order as $field)
                <td>
                    @if (isset($quantityInput) && $field === 'quantity')
                        <input class="w-12 field" type="text"
                            value="{{ isset($component[$field]) ? $component[$field] : '' }}" />
                    @else
                        {{ isset($component[$field]) ? $component[$field] : '' }}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach

</table>
