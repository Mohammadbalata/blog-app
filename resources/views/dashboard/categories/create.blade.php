<x-app-layout>
    <x-slot name="header">
        {{ __('Create Category') }}
    </x-slot>


    <form action="{{route('dashboard.categories.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.categories._form',['button_label' => 'Create']) 

    

    </form>

</x-app-layout>