
 <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569818907/jquery.table2excel.min.js"></script>

 <script>
     $(function() {
         $("#exportExcel").click(function(e){
             var table = $("#myTbl");
             
             if(table && table.length){
                 $(table).table2excel({
                     exclude: ".noExl",
                     name: "Excel Document Name",
                     filename: "{{ $fileName }}_" +  new Date().toISOString().slice(0,10) + ".xls",
                     fileext: ".xls",
                     exclude_img: true,
                     exclude_links: true,
                     exclude_inputs: true,
                     preserveColors: false
                 });
             }
         });

     });
 </script>