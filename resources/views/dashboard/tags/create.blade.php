<x-app-layout>
    <x-slot name="header">
        {{ __('Create Tag') }}
    </x-slot>


    <form action="{{route('dashboard.tags.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.tags._form',['button_label' => 'Create']) 

    

    </form>

</x-app-layout>