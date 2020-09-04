<li>
    <a href="{{route('category.filter', $child_category->slug)}}" 
        class="filter-category {{$currCategory->slug == $child_category->slug ? 'text-dark font-weight-bold' : ''}}"
        data-link="{{$child_category->slug}}"
    >
        {{$child_category->title}}
    </a>
</li>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('site.category.child_category', ['child_category' => $childCategory, 'currCategoey' => $currCategory])
    @endforeach
@endif
