<script>
    $(document).on('click' , '.delete-row', function (e) {
        e.preventDefault()
        Swal.fire({
            title: "{{__('هل تريد الاستمرار ؟')}}",
            text: "{{__('هل انت متأكد انك تريد استكمال عملية الحذف')}}",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{awtTrans("تأكيد")}}',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonText: '{{awtTrans("الغاء")}}',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
            }).then( (result) => {
            if (result.value) {
                $.ajax({
                    type: "delete",
                    url: $(this).data('url'),
                    data: {},
                    dataType: "json",
                    success:  (response) => {
                        Swal.fire(
                        {
                            position: 'top-start',
                            type: 'success',
                            title: '{{awtTrans('تم الحذف بنجاح')}}',
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        })
                        // toastr.error()
                        $('.data-list-view').DataTable().row($(this).closest('td').parent('tr')).remove().draw();
                    }
                });
            }
        })
    });
</script>