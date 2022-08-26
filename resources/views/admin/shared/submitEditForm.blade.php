<script>
    $(document).ready(function(){
        $(document).on('submit','.store',function(e){
            e.preventDefault();
            var url = $(this).attr('action')
            $.ajax({
                url: url,
                method: 'post',
                data: new FormData($(this)[0]),
                dataType:'json',
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $(".submit_button").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').attr('disable',true)
                },
                success: function(response){
                    $(".text-danger").remove()
                    $('.store input').removeClass('border-danger')
                    $(".submit_button").html("{{awtTrans('تعديل')}}").attr('disable',false)
                    Swal.fire({
                                position: 'top-start',
                                type: 'success',
                                title: '{{awtTrans('تمت التعديل بنجاح')}}',
                                showConfirmButton: false,
                                timer: 1500,
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                            })
                    setTimeout(function(){
                        window.location.replace(response.url)
                    }, 1000);
                },
                error: function (xhr) {
                    $(".submit_button").html("{{awtTrans('تعديل')}}").attr('disable',false)
                    $(".text-danger").remove()
                    $('.store input').removeClass('border-danger')

                    $.each(xhr.responseJSON.errors, function(key,value) {
                        $('.store input[name='+key+']').addClass('border-danger')
                        $('.store input[name='+key+']').after(`<span class="mt-5 text-danger">${value}</span>`);
                        $('.store select[name='+key+']').after(`<span class="mt-5 text-danger">${value}</span>`);
                    });
                },
            });

        });
    });
</script>