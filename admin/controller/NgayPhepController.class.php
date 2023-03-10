<?php

class NgayPhepController extends NgayPhep
{

    public function index()
    {
        $kq = self::getAll();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $kqOne = self::getOne($id);
        }
        include 'views/NgayPhep/index.php';
    }

    public function create()
    {
        if ((isset($_POST['addnp'])) && ($_POST['addnp'])) {
            $maNV = $_POST['maNV'];
            $soNgayHienTai = 0;
            $tongSoNgay = $_POST['tongSoNgay'];
            $nam = $_POST['nam'];
            $ghiChu = "";
            self::insertNP($maNV, $soNgayHienTai, $tongSoNgay, $nam, $ghiChu);
            header('location: index.php?act=ngayphep&q=index');
        }
        $this->index();

    }

    public function update()
    {
        if (isset($_POST['maPhep'])) {
            $maNV = $_POST['maNV'];
            $soNgayHienTai = $_POST['soNgayHienTai'];
            $tongSoNgay = $_POST['tongSoNgay'];
            $nam = $_POST['nam'];
            $ghiChu = $_POST['ghiChu'];
            $maPhep = $_POST['maPhep'];
            self::updateNP($maPhep, $maNV, $soNgayHienTai, $tongSoNgay, $nam, $ghiChu);
        }
        $this->index();
    }
    public function delete()
    {
        if (isset($_GET['id']) && !isset($_GET['confirm'])) {
            $id = $_GET['id'];
            self::deleteNP($id);
        }
        $this->index();
    }

    public function __call($methodName, $argument) {
        header('location: index.php?act=ngayphep&q=index');
    }

}