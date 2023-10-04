<x-app-layout>
    <x-slot name="header">
        {{ __('Create Article') }}
    </x-slot>


    <form action="{{route('dashboard.articles.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('dashboard.articles._form',['button_label' => 'Create']) 


    </form>

</x-app-layout>