<li><a href="{{route('site.category', $child_category->slug)}}">{{$child_category->title}}</a></li>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('site.category.child_category', ['child_category' => $childCategory])
    @endforeach
@endif
