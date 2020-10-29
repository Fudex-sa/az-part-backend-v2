

@extends('site.app')

@section('title') @lang('site.report_complain') @endsection

@section('styles')
    
    
@endsection

@section('content')

<section class="manual-search">
    <div class="container">
      <div class="row">
        @include('layouts.breadcrumb')
 
        <div class="col-md-12">
          
            <form class="pop-margin" method="POST" action="{{ route('send_report') }}">
              @csrf
              
            <input type="hidden" name="seller_id" class="seller_id" value="{{ request()->id }}" />
       
                <div class="form-group row">
       
                  <div class="col-md-12">
                    <label class="col-md-2"> @lang('site.complain_type') </label>

                    <div class="col-md-10">
                      @foreach ($complains as $complain)
                        <label> <input type="radio" name="complain_id" value="{{ $complain->id }}" required
                          {{ old('complain_id') == $complain->id ? 'checked' : ''}} /> 
                          {{ $complain['name_'.my_lang()] }} </label>
                      @endforeach

                      <label> <input type="radio" name="complain_id" value="0" />  @lang('site.other') </label>
                    </div>
                  </div>
       
                
               <div class="form-group col-md-8" style="display: none;" id="other">
                  <label class="col-md-2"> @lang('site.complain') </label>
                  
                  <div class="col-md-10">
                    <textarea name="comment" class="form-control"> </textarea>
                  </div>
               </div>
        
               <div class="col-md-2">
                  <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.send') </button>
               </div>
              </form>
 
        </div>

      </div>

    </div>
  </section>


@endsection

@section('popup')
    
     
@endsection


@section('scripts')
  
<script>
    $(document).on("click","input[name=complain_id]:radio",function(){
        
        var complain_id = $(this).val();

        if(complain_id == 0) $("#other").show();
        else $("#other").hide();

    });
</script>

@endsection

   