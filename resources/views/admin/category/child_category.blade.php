<li >
    <span>{{$child_category->title}}</span>
    &ensp;
    <a href="" data-toggle="modal" data-target="#modal-default" class="category-edit" data-link="{{route('category.show', $child_category->id)}}">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a href="{{route('category.delete', $child_category->id)}}" data-method="DELETE">
        <i class="fas fa-trash-alt"></i>
    </a>
    <a class="create-new-category" href="#" data-id={{$child_category->id}} data-title = {{$child_category->title}}>
        <i class="fas fa-plus"></i>
    </a>
</li>
@if ($child_category->categories)
<ul class="tree-view">
    @foreach ($child_category->categories as $childCategory)
        @include('admin.category.child_category', ['child_category' => $childCategory])
    @endforeach
</ul>
    
@endif