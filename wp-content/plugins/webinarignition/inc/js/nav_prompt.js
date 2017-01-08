
   $ = jQuery;

   $(function() {

      $('form').areYouSure();
      $('form.dirty-check').areYouSure();
      $('form').areYouSure( {'message':'Your changes are not saved!'} );

   });
