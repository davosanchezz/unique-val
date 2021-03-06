<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>Validación</title>

     <link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.css">
</head>
<body>
     <div class="container">
          <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <form id="formSave" action="https://hooks.zapier.com/hooks/catch/5112906/omh1g1r" method="post">
                    @csrf
                    <input type="hidden" id="urlvalidate" value="{{ route('store.local') }}">
                    <input type="hidden" name="id_referral" value="1037948744">
                    <input type="hidden" name="full_name"  value="Jhon Escudero">
                    <input type="hidden" name="email" value="jhon-escudero@hotmail.com">
                    <input type="hidden" name="phone" value="314769950">
                    <input type="hidden" name="city" value="colombia Antioquia Medellin">
                         <fieldset>
                              <legend>Validación de id</legend>
                              <div class="form-group">
                              <label for="icode">Código</label>
                                        <input type="text" class="form-control" id="icode" name="code">
                                        <small id="icode" class="form-text text-muted"></small>
                                   </div>
                              
                                   <div class="form-group">
                              <button class="btn btn-success" type="submit" id="btnSaveCode">Guardar</button>
                              </div>
                              
                         </fieldset>
                    </form>
               </div>
          </div>
     </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

$("#btnSaveCode").on('click', function(e){
     e.preventDefault();

     var urlValidate = $("#urlvalidate").val();
     var code = $("#icode").val();

     $.ajaxSetup({

          headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

     });

     $.ajax({
          type: "post",
          url: urlValidate,
          data: {code:code},
          success: function (response) {
               console.log(response); /** te imprimeen consola del navegador lo que devuelve el controlador */

               if(response == 'saved'){
                    alert('Código guardado en BD local, se procede a guardar en linea');
                    $("#formSave").submit();
               }

               if(response == 'failed'){
                    alert('Falló el proceso de guardar en BD local');
               }

               
               if(response == 'isonline'){
                    alert('El código ya esta en linea');
               }

               /**de momento siempre va ser 0 el valor de si esta en linea o no, ya que despues
                * deque hagas post, te debería devolver si se guardo el codigo a traves de la api que uses
                * suerte PARCE
                */
               if(response == 'needtopost'){
                    alert('El código se guardara en linea');
                    $("#formSave").submit();
               }
          }
     });

});

</script>     
</body>
</html>