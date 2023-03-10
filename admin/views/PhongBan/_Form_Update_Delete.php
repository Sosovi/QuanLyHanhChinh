<div class="text-center mt-3">
    <h3>CẬP NHẬT PHÒNG</h3>
    <hr>
    <form id="formPB" method="POST" action="index.php?act=phongban&q=update" class="">
        <div class="mb-3 mt-3 row justify-content-center">
            <label for="tenPhong" class="col-2 col-form-label offset-2">Tên phòng</label>
            <div class="col">
                <input type="text" class="form-control shadow-sm" id="tenPhong" name="tenPhong"
                       placeholder="Tên phòng..." value="<?= $kqOne['tenPhong'] ?>">
            </div>
        </div>

        <div class="mb-3 row justify-content-center">
            <label for="vietTat" class="col-2 col-form-label offset-2">Tên viết tắt</label>
            <div class="col">
                <input type="text" class="form-control shadow-sm" id="vietTat" name="vietTat"
                       placeholder="Tên viết tắt..." value="<?= $kqOne['vietTat'] ?>">
            </div>
        </div>

        <div class="mb-3 row justify-content-center">
            <label for="vietTat" class="col-2 col-form-label offset-2">Ghi chú</label>
            <div class="col">
                <input type="text" class="form-control shadow-sm" id="ghiChu" name="ghiChu"
                       placeholder="Ghi chú..." value="<?= $kqOne['ghiChu'] ?>">
            </div>
        </div>

        <input type="hidden" name="maPhong" value="<?= $kqOne['maPhong'] ?>">

        <div class="mb-3 row">
            <div class="col-6">
                <?php echo (isset($_GET['confirm'])) ? false : '<button type="submit" class="btn text-light d-inline-block btn-sakura">Cập nhật</button>'; ?>
            </div>
            <div class="col-6" id="confirm">

            </div>
        </div>
    </form>
</div>