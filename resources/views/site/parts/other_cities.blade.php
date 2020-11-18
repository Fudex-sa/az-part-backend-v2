
<div id="other_cities" class="modal fade my-popup" role="dialog">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content text-right">
    
      <div class="modal-body">
        <div class="m-header row mb-3">
    
          <h3 class="modal-title another-city-info col-md-10" id="exampleModalLabel">  @lang('site.result_in_other_cities') </h3>
          <button type="button" class="close col-md-2" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="">&times;</span>
          </button>
        </div>
        <div class="m-tabel mt-5">
          <table class="table">
            <thead>
              <tr>
                <th> @lang('site.city') </th>
                <th> @lang('site.stores_no') </th>
                <th> @lang('site.view') </th>
              </tr>
            </thead>

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
          </table>
        </div>
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn" data-dismiss="modal"> @lang('site.close') </button>
      </div>
    </div>
  </div>
  
</div>

 