<?php

require_once __DIR__ . '/../core/Controller.php';

class sinhvien extends Controller {
    public function index() {
        $sinhvienModel = $this->model('SinhvienModel');

        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = isset($_GET['per_page']) ? intval($_GET['per_page']) : 5;
        $perPage = in_array($perPage, [5, 10, 20, 50]) ? $perPage : 5;
        $search = trim($_GET['search'] ?? '');
        $gender = trim($_GET['gender'] ?? '');

        $totalCount = $sinhvienModel->getSinhvienCount($search, $gender);
        $totalPages = $totalCount > 0 ? ceil($totalCount / $perPage) : 1;
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        $offset = ($currentPage - 1) * $perPage;
        $sinhviens = $sinhvienModel->getAllSinhvien($search, $gender, $perPage, $offset);

        $startRecord = $totalCount > 0 ? $offset + 1 : 0;
        $endRecord = min($offset + count($sinhviens), $totalCount);

        $this->view('sinhvien/index', [
            'sinhviens' => $sinhviens,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'perPage' => $perPage,
            'totalCount' => $totalCount,
            'search' => $search,
            'gender' => $gender,
            'startRecord' => $startRecord,
            'endRecord' => $endRecord,
        ]);
    }

    public function create() {
        $sinhvienModel = $this->model('SinhvienModel');
        $lopModel = $this->model('LopModel');
        $errors = [];
        $values = [
            'hoten' => '',
            'mssv' => '',
            'gioitinh' => '',
            'lop_id' => '',
        ];

        $lops = $lopModel->getAllLopList();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $values['hoten'] = trim($_POST['hoten'] ?? '');
            $values['mssv'] = trim($_POST['mssv'] ?? '');
            $values['gioitinh'] = trim($_POST['gioitinh'] ?? '');
            $values['lop_id'] = intval($_POST['lop_id'] ?? 0);

            if ($values['hoten'] === '' || $values['mssv'] === '' || $values['gioitinh'] === '' || $values['lop_id'] <= 0) {
                $errors[] = 'Vui lòng điền đầy đủ thông tin và chọn lớp.';
            } else {
                $sinhvienModel->insertSinhvien($values['hoten'], $values['mssv'], $values['gioitinh'], $values['lop_id']);
                header('Location: index.php?url=sinhvien/index');
                exit();
            }
        }

        $this->view('sinhvien/create', [
            'title' => 'Thêm sinh viên',
            'errors' => $errors,
            'values' => $values,
            'lops' => $lops,
        ]);
    }

    public function edit($id = null) {
        $sinhvienModel = $this->model('SinhvienModel');
        $lopModel = $this->model('LopModel');
        $id = intval($id);
        $sinhvien = $sinhvienModel->getSinhvienById($id);

        if (!$sinhvien) {
            header('Location: index.php?url=sinhvien/index');
            exit();
        }

        $lops = $lopModel->getAllLopList();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = trim($_POST['hoten'] ?? '');
            $gioitinh = trim($_POST['gioitinh'] ?? '');
            $lop_id = intval($_POST['lop_id'] ?? 0);

            if ($hoten === '' || $gioitinh === '' || $lop_id <= 0) {
                $errors[] = 'Vui lòng điền đầy đủ thông tin và chọn lớp.';
            } else {
                $sinhvienModel->updateSinhvien($id, $hoten, $gioitinh, $lop_id);
                header('Location: index.php?url=sinhvien/index');
                exit();
            }
        }

        $this->view('sinhvien/edit', [
            'title' => 'Cập nhật sinh viên',
            'errors' => $errors,
            'sinhvien' => $sinhvien,
            'lops' => $lops,
        ]);
    }

    public function delete($id = null) {
        $sinhvienModel = $this->model('SinhvienModel');
        $id = intval($id);
        if ($id > 0) {
            $sinhvienModel->deleteSinhvien($id);
        }
        header('Location: index.php?url=sinhvien/index');
        exit();
    }
}
