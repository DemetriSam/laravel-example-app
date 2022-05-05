<div class="card ~neutral @low" {{ $attributes }}>
    <h2 class="text-lg font-bold">{{ $title }}</h2>
    <form action="{{ route($actionname) }}" method="post">
        <fieldset>
            @csrf
            {{ $slot }}
        </fieldset>
        <button type="submit" class="button ~urge @high button-xl">Отправить</button>
        @error('title')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
    </form>
</div>
