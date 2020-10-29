
@extends('site.app')

@section('title') 
    @lang('site.request') {{ $item->id }} : 
    {{ $item->piece_alt ? $item->piece_alt['name_'.my_lang()] : '' }}  @endsection

@section('styles')
    
@endsection

@section('content')

 
<section class="manual-search">
  <div class="container">
    <div class="row">
      @include('layouts.breadcrumb')

      
      <div class="col-md-12">
         
        
        <div class="results">
          <h6>   عدد النتائج :   <span class="text-dark">نتيجة 13445</span> </h6>
        </div>
      </div>
      <!-- start new row -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="search-box shadow">
          <div class="s-box-head">
            <img src="assets/images/search-box.png" alt="" class="img-fluid">
          </div>
          <div class="s-box-body">
            <h4> إسم القطعة</h4>
            <h6>إسم الماركة الخاصة بالقطعة</h6>
          </div>
          <div class="s-box-footer">
            <a href="#" class="btn btn-client float-left"> أضف للسلة</a>
            <h6><span>190</span>ريال سعودي</h6>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="search-box shadow">
          <div class="s-box-head">
            <img src="assets/images/search-box.png" alt="" class="img-fluid">
          </div>
          <div class="s-box-body">
            <h4> إسم القطعة</h4>
            <h6>إسم الماركة الخاصة بالقطعة</h6>
          </div>
          <div class="s-box-footer">
            <a href="#" class="btn btn-client float-left"> أضف للسلة</a>
            <h6><span>190</span>ريال سعودي</h6>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="search-box shadow">
          <div class="s-box-head">
            <img src="assets/images/search-box.png" alt="" class="img-fluid">
          </div>
          <div class="s-box-body">
            <h4> إسم القطعة</h4>
            <h6>إسم الماركة الخاصة بالقطعة</h6>
          </div>
          <div class="s-box-footer">
            <a href="#" class="btn btn-client float-left"> أضف للسلة</a>
            <h6><span>190</span>ريال سعودي</h6>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="search-box shadow">
          <div class="s-box-head">
            <img src="assets/images/search-box.png" alt="" class="img-fluid">
          </div>
          <div class="s-box-body">
            <h4> إسم القطعة</h4>
            <h6>إسم الماركة الخاصة بالقطعة</h6>
          </div>
          <div class="s-box-footer">
            <a href="#" class="btn btn-client float-left"> أضف للسلة</a>
            <h6><span>190</span>ريال سعودي</h6>
          </div>
        </div>
      </div>
      <!-- start new row -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="search-box shadow">
          <div class="s-box-head">
            <img src="assets/images/search-box.png" alt="" class="img-fluid">
          </div>
          <div class="s-box-body">
            <h4> إسم القطعة</h4>
            <h6>إسم الماركة الخاصة بالقطعة</h6>
          </div>
          <div class="s-box-footer">
            <a href="#" class="btn btn-client float-left"> أضف للسلة</a>
            <h6><span>190</span>ريال سعودي</h6>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="search-box shadow">
          <div class="s-box-head">
            <img src="assets/images/search-box.png" alt="" class="img-fluid">
          </div>
          <div class="s-box-body">
            <h4> إسم القطعة</h4>
            <h6>إسم الماركة الخاصة بالقطعة</h6>
          </div>
          <div class="s-box-footer">
            <a href="#" class="btn btn-client float-left"> أضف للسلة</a>
            <h6><span>190</span>ريال سعودي</h6>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="search-box shadow">
          <div class="s-box-head">
            <img src="assets/images/search-box.png" alt="" class="img-fluid">
          </div>
          <div class="s-box-body">
            <h4> إسم القطعة</h4>
            <h6>إسم الماركة الخاصة بالقطعة</h6>
          </div>
          <div class="s-box-footer">
            <a href="#" class="btn btn-client float-left"> أضف للسلة</a>
            <h6><span>190</span>ريال سعودي</h6>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="search-box shadow">
          <div class="s-box-head">
            <img src="assets/images/search-box.png" alt="" class="img-fluid">
          </div>
          <div class="s-box-body">
            <h4> إسم القطعة</h4>
            <h6>إسم الماركة الخاصة بالقطعة</h6>
          </div>
          <div class="s-box-footer">
            <a href="#" class="btn btn-client float-left"> أضف للسلة</a>
            <h6><span>190</span>ريال سعودي</h6>
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