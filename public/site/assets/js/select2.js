

$(document).ready(function () {         
  $(".select2").select2({
      templateResult: formatState,
      templateSelection: formatState
  });

  function formatState (opt) {
      if (!opt.id) {
          return opt.text.toUpperCase();
      } 

      var optimage = $(opt.element).attr('data-image'); 
      console.log(optimage)
      if(!optimage){
        return opt.text.toUpperCase();
      } else {                    
          var $opt = $(
            '<span><img src="' + optimage + '" " /> ' + opt.text.toUpperCase() + '</span>'
          );
          return $opt;
      }
  };
});