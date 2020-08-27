@extends('site.layout.master')

@section('content')
    @include('site.partials.banner')
<!-- s-content
    ================================================== -->
    <section class="s-content">
        <div class="row entries-wrap wide">
            <div class="entries">

                @foreach ($posts as $post)
                    <article class="col-block">
                        
                        <div class="item-entry" data-aos="zoom-in">
                            <div class="item-entry__thumb">
                                <a href="{{route('site.post', $post->slug)}}" class="item-entry__thumb-link">
                                    <img src="{{asset('/upload/image/post/' . $post->images[0]->image)}}" alt="">
                                </a>
                            </div>
            
                            <div class="item-entry__text">    
                                <div class="item-entry__cat">
                                    <a href="{{route('site.category', $post->category->slug)}}">{{$post->category->title}}</a> 
                                </div>
        
                                <h1 class="item-entry__title"><a href="{{route('site.post', $post->slug)}}">{{$post->title}}</a></h1>
                                    
                                <div class="item-entry__date">
                                    <a href="{{route('site.post', $post->slug)}}">{{$post->updated_at}}</a>
                                </div>
                            </div>
                        </div> <!-- item-entry -->

                    </article> <!-- end article -->
                    
                @endforeach

            </div> <!-- end entries -->
        </div> <!-- end entries-wrap -->

        {{$posts->links('site.partials.pagination', ['paginator' => $posts, 'rangeLimit' => '5'])}}

    </section> <!-- end s-content -->
@endsection