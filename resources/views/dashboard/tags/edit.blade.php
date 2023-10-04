<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Tag') }}
    </x-slot>


    <form action="{{route('dashboard.tags.update',$tag->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('dashboard.tags._form') 

    </form>

</x-app-layout>