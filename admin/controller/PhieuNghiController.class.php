<?php

class PhieuNghiController extends PhieuNghi
{
    public function index()
    {
        $kq = self::getAll($_SESSION['userID']);

        $pb = new PhongBanController();
        // Lấy phòng ban của user đang login hiện tại, chỉ được duyệt những người cùng phòng mình
        $phongBan = $pb->findNV($_SESSION['userID']);
        $kqQuanLy = self::getAllNV_FromPB($phongBan['maPhong']);
        if (isset($_POST['addtp'])) {
            $checkNP = self::checkNP();
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $kqOne = self::getOne($id);
        }
        include 'views/TaoPhieu/index.php';
    }

    public function checkNP()
    {
        $np = new NgayPhep();
        $kq = $np->findNV($_SESSION['userID']);
        $ngayNghiConLai = $kq['tongSoNgay'] - $kq['soNgayHienTai'];
        $soNgayNghi = $_POST['tongSoNgay'];
        $loaiPhep = $_POST['loaiPhep'];
//        $soNgayNghi = date('d', strtotime($_POST['den_ngay']) - strtotime($_POST['tu_ngay'])) - 1;
        if ($soNgayNghi > $ngayNghiConLai && $loaiPhep != 4) {
            return false;
        }
        return true;
    }

    public function create()
    {
        if ((isset($_POST['addtp'])) && ($_POST['addtp'])) {
            if (self::checkNP()) {
                $maNV = $_SESSION['userID'];
                $tongSoNgay = $_POST['tongSoNgay'];
                $tu_buoi = $_POST['tu_buoi'];
                $den_buoi = $_POST['den_buoi'];
                $tu_ngay = $_POST['tu_ngay'];
                $den_ngay = $_POST['den_ngay'];
                $loaiPhep = $_POST['loaiPhep'];
                $ghiChu = '';
                $nguoi_duyet = null;
                $trang_thai = 0;
                $ngay_duyet = date('Y-m-d');
                self::insertPN($maNV, $tongSoNgay, $tu_buoi, $den_buoi, $tu_ngay, $den_ngay, $loaiPhep, $ghiChu,
                    $nguoi_duyet, $trang_thai, $ngay_duyet);
            }
        }

        $this->index();
    }

    public function showConfirm()
    {
        $this->index();
    }

    public function Confirm()
    {
        $np = new NgayPhepController();
        $kq = $np->findNV($_POST['maNV']);
        $ngay_duyet = date('Y-m-d');
        $nguoi_duyet = $_SESSION['userID'];
        if ((isset($_POST['accept'])) && ($_POST['accept'])) {
            $tongSoNgay = $kq['soNgayHienTai'] + $_POST['tongSoNgay'];
            self::updatePN(1,$nguoi_duyet,$ngay_duyet,$_POST['maPhieu']);
            self::updateTongNgay($tongSoNgay,$_POST['maNV']);
        } else {
            self::updatePN(-1,$nguoi_duyet,$ngay_duyet,$_POST['maPhieu']);
        }
        $this->index();
    }

    public function delete()
    {
        $this->index();
    }

    public function __call($methodName, $argument)
    {
        header('location: index.php?act=taophieu&q=index');
    }

}