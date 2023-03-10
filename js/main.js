$(document).ready(function () {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }


    $('#maPhong').change(function () {
        let inputValue = $(this).val();
        $.post('views/api.php', {maPhong: inputValue}, function (data) {
            $('#maNV').html(data);
        });
    });

    $('#addpb').click(function (e) {
        let tenPhong = $('#tenPhong').val();
        let vietTat = $('#vietTat').val();
        let ghiChu = $('#ghiChu').val();
        let toastLiveExample = $('#liveToast');
        $.post('views/api.php', {
            tenPhong: tenPhong,
            vietTat: vietTat,
            ghiChu: ghiChu,
            addpb: 'addpb'
        }, function (data) {
            $('#tablePB').append(data);
            toastr["info"](`Thêm thành công phòng ${tenPhong}`);
        });
        $('#tenPhong').val('');
        $('#vietTat').val('');
        $('#ghiChu').val('');
    });

    $('#tablePB').on("click", ".btnXoa", function () {
        let id = $(this).data('id');
        let act = $(this).data('act');
        if (act == 'phongban') {
            $.post('views/api.php', {maPhongPB: id, confirm: 'confirm'}, function (data) {
                $('#confirm').html(data);
            });

        }
    });

    $('#formPB').on("click", "#btnConfirm",function () {
        let id = $(this).data('id');
        let act = $(this).data('act');
        let btnXoa =  $('.btnXoa').filter(function(){
            return $(this).data("id")   == id});
        let tenPhong = btnXoa.data('tenphong');
        let parent_tr = btnXoa.parents('tr');
        if (act == 'phongban') {
            $.post('views/api.php', {id: id, delete: 'delete'}, function (data) {
                parent_tr.remove();
                $('#confirm').html('');
                toastr["info"](`Xóa thành công phòng ${tenPhong}`);
            })
        }
    });




    // $( '.btnXoa' ).click(function() {
    //     let id = $(this).data('id');
    //     let act = $(this).data('act');
    //     if (act == 'phongban') {
    //         $.post('views/api.php', { maPhongPB: id, confirm: 'confirm' }, function(data){
    //             $('#confirm').html(data);
    //         });
    //     }
    // });


});