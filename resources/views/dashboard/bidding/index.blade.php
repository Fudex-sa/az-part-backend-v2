@extends('Admin.layouts.app',['activePage' => 'cars', 'titlePage' => __('site.car_bidding')])
@section('content')
    @include('Admin.CarBinding.all')
@endsection

@section('popup')
        @foreach($items as $item)
            @include('Admin.CarBinding.edit',['item'=>$item])
            @include('Admin.CarBinding.bidderDetails',['item'=>$item])
            @include('Admin.CarBinding.carOwnerDetails',['item'=>$item])            
        @endforeach
@endsection


@section('scripts')
    <script>
        $(".remove").click(function () {
            var _token = "{{ csrf_token() }}";
            var item = $(this).attr('itemid');
            if (confirm("{{ __('site.confirm_delete') }}")) {
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/car-binding/delete') }}",
                    data: {_token: _token, item: item},
                    success: function (response) {
                        if(response == 1)
                        $.growl.notice({title: "Done",message: "{{ __('site.delete_success') }}"  });
                    }
                });
                var curtr = $(this).closest("tr");
                curtr.remove();
            }
        })
    </script>

    <script>
        function readURL(input) {
            var id = $(input).attr("id");
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('label[for="' + id + '"] .prev').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".inputfile").change(function () {
            readURL(this);
        });
    </script>
@endsection