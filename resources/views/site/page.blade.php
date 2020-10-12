
@extends('site.app')

@section('title') {{ $item['title_'.my_lang()] }} @endsection

@section('styles')
    
@endsection

@section('content')

<div class="about">
    <div class="container">
      <div class="row">
        
        @include('layouts.breadcrumb')

        <div class="col-md-8">
          <div class="privacy-box">
           
            {!! $item['content_'.my_lang()] !!}

          </div>
        </div>
 
        
      </div>
    </div>
  </div>

@endsection