@extends('layouts/master')

@section('content')
    
    <!--@if(true)
        <p>True</p>
    @else
        <p>False</p>
    @endif

    <ul>
        @for($i=0; $i<5; $i++)
            <li>{{$i+1}}. Iteration</li>
        @endfor
    </ul>

    <h2>XSS</h2>
    {!!'<script>alert("Hello");</script>'!!}-->

    <div class="row">
        <div class="col-md-12">
            <p class="quote">The beautiful Laravel</p>
        </div>
    </div>
         
    @foreach($posts as $post)
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="post-title">{{ $post->title }}</h1>
            <p>
                @foreach($post->tags as $tag)
                    - {{ $tag->name }} -
                @endforeach
            </p>
            <p>{{ $post->content }}</p>
            <!--Rutas con parametros-->
            <p><a href="{{ route('blog.post', ['id' => $post->id]) }}">Read more...</a></p>
        </div>
    </div>
    @endforeach


@endsection