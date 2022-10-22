$(document).ready(function() {
$('#swdatatable').dataTable({
    "iDisplayLength": 20,
    "aLengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]]
});

function loading(){
    $(".loading").show();
    $(".loading").delay(1500).fadeOut(500);
}

    /* -------------------- Edit ------------------- */
     $(document).on('click', '.update-status', function(){ 
            var id = $(this).attr("data-id");
            var status = $(this).attr("data-status");
        $.ajax({  
             url:"sw-mod/cuty/proses.php?action=update-status&status="+status+"",
             type:'POST',    
             data:{id:id}, 
                beforeSend: function () { 
                    loading();
                },
                success: function (data) {
                    if (data == 'success') {
                        swal({title: 'Berhasil!', text: 'Data berhasil disimpan.!', icon: 'success', timer: 2000,});
                        setTimeout(function(){ location.reload(); }, 2100);
                    } else {
                        swal({title: 'Oops!', text: data, icon: 'error', timer: 1500,});
                    }

                },
                complete: function () {
                    $(".loading").hide();
                },
        });
    });

});