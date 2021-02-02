<div class="row col-md-12 piecePart">

<hr class="dashed-hr"/>

 <div class="col-md-12">
    <a href="javascript:void(0);" class="remove-piece" onclick="removePiece(this)">
         <i class="fa fa-trash"></i> @lang('site.remove_piece') </a>
 </div>

<div class="col-md-4">
    <label> @lang('site.piece_name') </label>

     <select name="piece_alt_id[]" class="form-control select2" required>
        <option value=""> @lang('site.choose_piece') </option>
          @foreach ($piece_alts as $piece_alt)
            <option value="{{ $piece_alt->id }}"> {{ $piece_alt['name_'.my_lang()] }} </option>     
          @endforeach
     </select>
   </div>

   <div class="form-group col-md-4">
    <label> @lang('site.qty') </label>

    <input type="number" class="form-control" name="qty[]" min="1" value="1" placeholder="@lang('site.qty')">
  </div>

  @if(session()->get('search')['search_type'] == 'manual')
        <div class="form-group col-md-4">
          <label> @lang('site.price') </label>

          <input type="number" min="1" class="form-control" name="price[]"  required
              placeholder="@lang('site.price')"> @lang('site.rs')
        </div>

        <div class="form-group col-md-4">
        <label> @lang('site.guarantee') </label>

        <input type="text" class="form-control" name="guarantee[]"  placeholder="@lang('site.guarantee')">
        </div>
    @endif

    <div class="form-group col-md-4">
      <label> @lang('site.color') </label>
    
      <input type="text" class="form-control" name="color[]"  placeholder="@lang('site.color')">
    </div>

    <div class="form-group col-md-4">
      <label> @lang('site.piece_image') </label>

      <input type="file" class="form-control" name="photo[]">
    </div>
 

    <div class="form-group col-md-12">
      <label> @lang('site.notes') </label>

      <input type="text" class="form-control" name="notes[]"  placeholder="@lang('site.notes')">
    </div>


</div>