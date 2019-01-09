  $(".hapus").click(function () {
        var jawab = confirm("Apakah Anda Yakin Ingin Menghapus");
        if (jawab === true) {
//            kita set hapus false untuk mencegah duplicate request
            var hapus = false;
            if (!hapus) {
                hapus = true;
               var url = $(this).data("url");
               var redirect = $(this).data("redirect");
               $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
               $.ajax(
                {
                    url: url,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: {},
                    success: function (response)
                    {
                        if (response.kode='00') {
                          if (redirect.value=='') {
                             window.location.replace(redirect);
                          }else{
                             window.location.replace(redirect);
                          }
                        } else {
                          console.log(response.message);
                        }
                    },
                    error: function(xhr) {
                     console.log(xhr.responseText); 
                   }
                });

                hapus = false;
            }
        } else {
            return false;
        }
    });
