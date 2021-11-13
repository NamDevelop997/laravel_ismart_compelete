@extends('root_file')

@section('content')
    <section class="products-page ">
        <h2 class="text-center text-uppercase">Danh sách <span>bài viết</span> </h2>
        <p class="text-center">Danh sách bài viết</p>
        <div class="row mt-5 post">
            @foreach ($posts as $post)
                <div class="col-4 post-page-item text-dark row w3-animate-left">
                    <img class="col-5" src="{{ $post->thumbnail }}" alt="{{ $post->title }}" width="200px"
                        height="100">
                    <div class="post-page-content col-7">
                        <a href="">{{ Str::of($post->title)->limit(70) }}</a>
                        <p>{{ $post->created_at }}</p>
                    </div>
                </div>
            @endforeach
        </div>
       {{ $posts->links() }} 
    </section> 
@endsection

{{-- @section('contact')
    @parent
@endsection --}}
