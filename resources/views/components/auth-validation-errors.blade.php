@props(['errors'])

@if ($errors->any())
    <div {!! $attributes->merge(['class' => 'alert alert-danger']) !!} role="alert">
        <div class="text-white">{{ __('Whoops! Something went wrong.') }}</div>

        <div>
            @foreach ($errors->all() as $error)
                <p class="my-1">{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif
