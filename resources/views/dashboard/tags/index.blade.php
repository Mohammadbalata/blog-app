<x-app-layout>
    <x-slot name="header">
        {{ __('tags') }}
    </x-slot>

    <div class="md:px-32 py-8 w-full">
        <div class="py-6  ">
            <a href="{{route('dashboard.tags.create')}}" class="px-6 py-3 text-blue-100 no-underline bg-blue-500 rounded hover:bg-blue-600 ">
                Create
            </a>
        </div>
        <div class="shadow overflow-hidden rounded border-b border-gray-200 w-full">
            <table class=" bg-white w-full">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Id</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">name</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">created at</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($tags as $tag)
                    <tr id="tagid{{$tag->id}}" class="bg-gray-100">
                        <td class="w-1/3 text-left py-3 px-4">{{$tag->id}}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{$tag->name}}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{$tag->created_at}}</td>
                        <td class="w-1/3 text-left py-3 px-4">
                            <a href="{{route('dashboard.tags.edit',$tag->id)}}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                                Edit
                            </a>

                        </td>
                        <td class="w-1/3 text-left  py-3 pt-5 px-4">
                            {{--<form action="{{route('dashboard.tags.destroy',$tag->id)}}" method="post">
                            @csrf
                            @method('delete')
                            </form>--}}
                            <button onclick="deleteTag({{$tag->id}})" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td>No tags found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>