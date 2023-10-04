<x-form.input name="title" type='text' label="Title" :value="$article->title" />
<x-form.textarea name="body" label="Body" :value="$article->body" />
<div>
  <label class="block mb-2 my-2 font-medium text-gray-900 dark:text-white text-xl" for="name">Category</label>
  <select name="category_id" class=" {{$errors->has('category_id') ? '!border-red-600' : ''}} bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="">----</option>
    @foreach($categories as $category)
    <option value="{{$category->id}}" @selected(old('category_id',$article->category_id) == $category->id) > {{$category->name}} </option>
    @endforeach
  </select>
</div>
<div>
  <x-form.input label='Image' type="file" value="" name="image" />
  @if($article->image)
  <img class="mt-5" height="200" src="{{asset('storage/' . $article->image)}}" />
  @endif
</div>

<x-form.input label="Tags" name="tags" value="{{  $tags ?? '' }}" />

{{--<div class="w-full mt-4">
  <label class="inline-block text-sm text-gray-600" for="Multiselect">Select multiple tags</label>
  <div class="relative flex w-full">
    <select id="select-role" name="tags[]" multiple placeholder="Select roles..." autocomplete="off" class="block w-full rounded-sm cursor-pointer focus:outline-none" multiple>
      @foreach($tags as $tag)
      <option value="{{$tag->id}}">{{$tag->name}}</option>
      @endforeach
    </select>
  </div>
</div>--}}

{{--<x-form.input name="tags" label="Tags / seperated by , " value="{{$tags ?? '' }}" />--}}


<button type="submit" class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{$button_label ?? 'Save'}}</button>



@push('styles')
 <link href="{{ asset('css/tagify.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')

<script src="{{ asset('js/tagify.min.js') }}"></script>
<script src="{{ asset('js/tagify.polyfills.min.js') }}"></script> 
<script>
    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);
</script>
@endpush