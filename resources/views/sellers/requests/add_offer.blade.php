
@extends('site.app')

@section('title')  @lang('site.add_price') @endsection

@section('styles')
    
@endsection

@section('content')

<section class="profile">
  <div class="container">
    <div class="row">

      @include('layouts.breadcrumb')
 
      <div class="col-md-12">
        <div class="row">

          @include('layouts.nav_side_menu')          

          <div class="col-lg-9 col-md-9  col-12">
           
            <div class="head-section">
                <h2> @lang('site.add_price') </h2>         
            </div> 

            
            <form  method="post" action="{{ route('seller.send_price',$item->id) }}">
              @csrf

              <div class="row">
                <div class="form-group col-md-3">
                    <label> @lang('site.price') </label>
            
                <input type="number" name="price" min="0" class="form-control" value="{{ old('price') }}"/>
                </div>
            
                <div class="form-group col-md-3">
                    <label> @lang('site.composition') </label>
                    
                    <div class="form-check">
                        <label> <input type="radio" name="composition" value="1" {{ old('composition') == 1 ? 'checked' : '' }} checked> 
                        @lang('site.yes')  </label>
                            
                        <label> <input type="radio" name="composition" value="0" {{ old('composition') == 0 ? 'checked' : '' }}> 
                        @lang('site.no') </label>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label> @lang('site.return_possibility') </label>
                    
                    <div class="form-check">
                        <label> <input type="radio" name="return_possibility" value="1" {{ old('return_possibility') == 1 ? 'checked' : '' }} checked> 
                        @lang('site.yes')  </label>
                            
                        <label> <input type="radio" name="return_possibility" value="0" {{ old('return_possibility') == 0 ? 'checked' : '' }}> 
                        @lang('site.no') </label>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label> @lang('site.delivery_possibility') </label>
                    
                    <div class="form-check">
                        <label> <input type="radio" name="delivery_possibility" value="1" 
                            {{ old('delivery_possibility') == 1 ? 'checked' : '' }} checked> 
                        @lang('site.yes')  </label>
                            
                        <label> <input type="radio" name="delivery_possibility" 
                            value="0" {{ old('delivery_possibility') == 0 ? 'checked' : '' }}> 
                        @lang('site.no') </label>
                    </div>
                </div>

                <div class="form-group col-md-5">
                    <label> @lang('site.guarantee') </label>
                    
                    <div class="form-check">
                    <input type="text" name="guarantee" value="{{ old('guarantee') }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group col-md-6">
                  <label> @lang('site.notes') </label>
                  
                  <div class="form-check">
                  <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                  </div>
              </div>
                
                <button type="submit" class="btn btn-next btn-block btn-lg"> @lang('site.send') </button>
                </div>
              </form>

            



          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 
@endsection

@section('popup')
 
@endsection


@section('scripts')
   
@endsection