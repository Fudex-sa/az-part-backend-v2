
 
 //----------------- Mobile Validation --------------
 
 $(document).on("keydown","[name=mobile]",function () {
    var phone = $(this).val();         
    phone = phone.replace(/^0+/, '');  // Remove first digit if equal 0

    // Convert all arabic numbers to english
    phone = phone.replace(/۰/g, '0');
    phone = phone.replace(/۱/g, '1');
    phone = phone.replace(/۲/g, '2');
    phone = phone.replace(/۳/g, '3');
    phone = phone.replace(/۴/g, '4');
    phone = phone.replace(/۵/g, '5');
    phone = phone.replace(/۶/g, '6');
    phone = phone.replace(/۷/g, '7');
    phone = phone.replace(/۸/g, '8');
    phone = phone.replace(/۹/g, '9');

    $(this).val(phone);
});