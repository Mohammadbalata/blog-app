@props([
'type' => 'text', 'value' => '' ,'name' => '','label' => false
])
@if($label)
<label class="block mb-2 my-2 font-medium text-gray-900 dark:text-white text-xl" for="{{$name}}">{{$label}}</label>
@endif
<input type="{{$type}}" name="{{$name}}" id="{{$name}}" value="{{old($name,$value)}}" {{$attributes->class(['bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',' !border-red-600' => $errors->has($name)]) }}>
@error($name)
<div class="text-red-500">
    {{$errors->first($name)}}
</div>
@enderror