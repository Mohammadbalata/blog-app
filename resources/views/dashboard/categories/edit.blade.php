<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Category') }}
    </x-slot>


    <form action="{{route('dashboard.categories.update',$category->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('dashboard.categories._form') 

    </form>

</x-app-layout>