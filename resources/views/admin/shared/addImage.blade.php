<script>
    // ADD IMAGE
    $('.imageUploader').change(function (event){
        $(this).parents('.imagesUploadBlock').append('<div class="uploadedBlock"><img src="'+ URL.createObjectURL(event.target.files[0]) +'"><button class="close"><i class="la la-times"></i></button></div>');
    });

        $('.dropBox').on('click', '.close',function (){
        $(this).parent().remove();
    });

    $(".clickAdd").click(function (b){
        b.preventDefault();
        $('.dropBox').append('<div class="textCenter">' + '<div class="imagesUploadBlock">' + '<label class="uploadImg">' + '<span><i class="far fa-image"></i></span>' + '<input type="file" accept="image/*" class="imageUploader">' + '</label>' + '</div>' + '</div>');

        $('.imageUploader').change(function (event){
            $(this).parents('.imagesUploadBlock').append('<div class="uploadedBlock"><img src="'+ URL.createObjectURL(event.target.files[0]) +'"><button class="close"><i class="fas fa-times"></i></button></div>');
        });
        $('.dropBox').on('click', '.close',function (){
            $(this).parents('.textCenter').remove();
        });

    });

</script>