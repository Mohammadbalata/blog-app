@props([
   'name', 'selected' => '', 'label' => false, 'options'
])

@if($label)
<label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
@endif

<select 
    name="{{ $name }}"
    {{ $attributes->class([
        '',
        'is-invalid' => $errors->has($name)
    ]) }}
>
    <!-- {{-- @foreach($options as $value => $text)
    <option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>
    @endforeach --}} -->
</select>

<x-form.validation-feedback :name="$name" />