 
<div id="other_cities" class="modal fade my-popup" role="dialog">
    <div class="modal-dialog">
   
      <div class="modal-content">
        <div class="modal-header row">          
          <div class="col-md-11"> <h4 class="modal-title"> @lang('site.result_in_other_cities') </h4> </div>
          <div class="col-md-1"> <button type="button" class="close" data-dismiss="modal">&times;</button>   </div>
        </div>

        <div class="modal-body">
          <table class="my-tbl text-center">
            <thead>
                <tr>
                    <th> @lang('site.city') </th>
                    <th> @lang('site.stores_no') </th>
                    <th> @lang('site.view') </th>
                </tr>

                <tbody>
                    @foreach (cities_sellers() as $sel)
                        @if($sel->city_id)
                            <tr>
                                <td> {{ get_city($sel->city_id) ? get_city($sel->city_id)['name_'.my_lang()] : '' }} </td>
                                <td> {{ $sel->stores }} </td>
                                <td> <a href="{{ route('search.change',$sel->city_id) }}"> @lang('site.show') </a>  </td>
                            </tr>
                        @endif
                    @endforeach
                    
                </tbody>
            </thead>

          </table>
 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> @lang('site.close') </button>
        </div>
      </div>
  
    </div>
  </div>