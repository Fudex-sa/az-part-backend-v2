
@extends('site.app')

@section('title') {{__('site.notifications')}}  @endsection

@section('styles')
<style>
.notif h2{
color: #1584BB;
font-size: 34px;
margin-bottom: 20px;
font-weight: bold;
}
.notif h6{
  color: #767779;
  font-size: 22px;
  font-weight: bold;
  margin: 25px 0;

}
.notif h6 span{
  color: #C5363F;
}
.notif{

  border-bottom: 2px  solid rgba(206, 205, 205, 0.835);
}
.notif-add-del li a i{
  color: #C5363F;
  font-size: 24px;
}
.notif-add-del li a .fa-eye{
  color: #1584BB;
}
.notif-add-del li{
  display: inline-block;
  margin-left: 20px;
}
.notif-add-del{
  margin: 25px 0;
  float: left;
}
.border-none-2{
  border: transparent !important;
}
</style>
@endsection

@section('content')

<section class="manual-search">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- start breadcramb -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>

            <li class="breadcrumb-item active" aria-current="page">  الاخطارات </li>
          </ol>
        </nav>
      </div>
      <div class="col-md-12">
        <div class="notif row">
          <h2 class="col-md-12">الاخطارات</h2>
          <h6 class="col-md-12"> بامكانك المتابعه والتحكم بالاخطارات الخاصه بك</h6>
        </div>
      </div>

      @if(isset($notifications))
                        @foreach($notifications as $notification)

                            @if($notification->car)
      <div class="col-md-12">
        <div class="notif  row ">
          <div class="col-md-9">
             <h6> <span>  تم اضافة سيارة جديدة وهى   {{$notification->car['title']}}</span></h6>

          </div>
          <div class="col-md-3">
            <ul class="notif-add-del">
              <li><a href="{{url('/car/'.$notification->car_id)}}"><i class="fas fa-eye"></i></a></li>

              <li><a href="{{ route('notification.delete',$notification->id) }}"><i class="fas fa-trash-alt"></i></a></li>

            </ul>
          </div>
        </div>
      </div>

      @endif


      @endforeach
  @endif





    </div>

  </div>
</section>

@endsection
