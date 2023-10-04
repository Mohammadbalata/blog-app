<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Article') }}
    </x-slot>


    <form action="{{route('dashboard.articles.update',$article->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('dashboard.articles._form') 

    </form>

</x-app-layout>