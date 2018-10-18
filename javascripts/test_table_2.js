 $(document).ready(function() {
     doAjax();
 });

 doAjax = function() {
     $.ajax({
         type: 'POST',
         url: 'test_table_2.php',
         success: function(data) {
             $('.row').append(data);
         }
     });
 };
