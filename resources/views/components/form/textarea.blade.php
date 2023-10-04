@props([
'name', 'value' => '', 'label' => false
])

@if($label)
<label class="block mb-2 my-2 font-medium text-gray-900 dark:text-white text-xl" for="{{ $name }}">{{ $label }}</label>
@endif

<textarea rows="4" id="{{ $name }}" name="{{ $name }}" {{ $attributes->class([
    "block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500",
        '!border-red-600' => $errors->has($name)
    ]) }}>{{ old($name, $value) }}</textarea>
    @error($name)
<div class="text-red-500">
    {{$errors->first($name)}}
</div>
@enderror