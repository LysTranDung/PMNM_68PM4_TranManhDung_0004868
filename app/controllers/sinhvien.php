<?php

    require_once '../app/core/Controller.php';
    require_once '../app/models/sinhvienModel.php';
    class sinhvien extends Controller {
        public function index(){
            $sinhvienModel = $this->model('sinhvienModel');
            $sinhviens = $sinhvienModel->getAllSinhVien();

            $this->view('sinhvien/index', ['sinhviens' => $sinhviens]);
        }
        public function create(){
            $this->view("sinhvien/create", ["title" => "Thêm sinh viên"]);
        }
    }






=======
class sinhvien{
    public function index(){
        require_once "../app/views/sinhvien/index.php";
    }

    public function create(){
        require_once "../app/views/sinhvien/create.php";
    }
}
>>>>>>> f36696361597fc57af1d538b401e57fe9cb24167
?>