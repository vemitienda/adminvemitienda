(function ($, DataTable) {

    var $avatarInput, $avatarImage, $avatarForm, $imagenInput, $imagenImage, $imagenForm;
    var avatarUrl, imagenUrl;
    var $avatar = window.location.origin + '/img/avatar.png';

    $(function () {
        $avatarInput    = $('#avatarInput');
        $avatarImage    = $('.avatarImage');
        $avatarForm     = $('#avatarForm');

        $avatarImage.on('click', function () {
            $avatarInput.click();
        });

        avatarUrl = $avatarForm.attr('action'); //Ruta ajax para subir imagen
        $avatarInput.on('change', function () {
            if($avatarInput.val()){
                var formData = new FormData();
                formData.append('imagen', $avatarInput[0].files[0]);
                formData.append('users_id', $('#users_id').val());
                $.ajax({
                    url: avatarUrl,
                    beforeSend: function(){
                        preloader($avatarInput);
                    },
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(function (data) {
                    if (data.success) {
                        location.reload();
                        //$avatarImage.attr("src",data.url);
                        //$avatarInput.attr("disabled",false); 
                    }
                }).fail(function () {
                    $avatarImage.attr("src",$avatar);
                    $avatarInput.attr("disabled",false);
                    alert('Error con la imagen seleccionada');
                });
            }
            

        });

        // ************************** Para imagenes en general ****************************************************

        $imagenInput = $('#imagenInput');
        $imagenImage = $('.imagenImage');
        $imagenForm = $('#imagenForm');

        $imagenImage.on('click', function () {
            $imagenInput.click();
        });

        $imagenInput.on('change', function (event) {
            $imagenImage.attr('src', URL.createObjectURL(event.target.files[0]));
        });

    });

})(jQuery);


function preloader($avatarInput){
        $('#box-avatar').hide();
        $('#box-loader').show();
        $avatarInput.attr("disabled",true);
}
