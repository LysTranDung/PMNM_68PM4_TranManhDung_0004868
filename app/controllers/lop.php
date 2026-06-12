<?php
require_once __DIR__ . '/../core/Controller.php';

class lop extends Controller {
    public function index() {
        $lopModel = $this->model('LopModel');

        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = isset($_GET['per_page']) ? intval($_GET['per_page']) : 5;
        $perPage = in_array($perPage, [5, 10, 20, 50]) ? $perPage : 5;
        $search = trim($_GET['search'] ?? '');

        $totalCount = $lopModel->getLopCount($search);
        $totalPages = $totalCount > 0 ? ceil($totalCount / $perPage) : 1;
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        $offset = ($currentPage - 1) * $perPage;
        $lops = $lopModel->getAllLop($search, $perPage, $offset);

        $startRecord = $totalCount > 0 ? $offset + 1 : 0;
        $endRecord = min($offset + count($lops), $totalCount);

        $this->view('lop/index', [
            'lops' => $lops,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'perPage' => $perPage,
            'totalCount' => $totalCount,
            'search' => $search,
            'startRecord' => $startRecord,
            'endRecord' => $endRecord,
        ]);
    }

    public function create() {
        $lopModel = $this->model('LopModel');
        $errors = [];
        $values = [
            'tenlop' => '',
            'khoa' => '',
            'siso' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $values['tenlop'] = trim($_POST['tenlop'] ?? '');
            $values['khoa'] = trim($_POST['khoa'] ?? '');
            $values['siso'] = trim($_POST['siso'] ?? '');

            if ($values['tenlop'] === '' || $values['khoa'] === '' || $values['siso'] === '') {
                $errors[] = 'Vui lòng điền đầy đủ thông tin.';
            } elseif (!is_numeric($values['siso']) || intval($values['siso']) < 0) {
                $errors[] = 'Sĩ số phải là số nguyên dương.';
            } else {
                $lopModel->insertLop($values['tenlop'], $values['khoa'], intval($values['siso']));
                header('Location: index.php?url=lop/index');
                exit();
            }
        }

        $this->view('lop/create', [
            'title' => 'Thêm lớp học mới',
            'errors' => $errors,
            'values' => $values,
        ]);
    }

    public function edit($id = null) {
        $lopModel = $this->model('LopModel');
        $id = intval($id);
        $lop = $lopModel->getLopById($id);
        if (!$lop) {
            header('Location: index.php?url=lop/index');
            exit();
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenlop = trim($_POST['tenlop'] ?? '');
            $khoa = trim($_POST['khoa'] ?? '');
            $siso = trim($_POST['siso'] ?? '');

            if ($tenlop === '' || $khoa === '' || $siso === '') {
                $errors[] = 'Vui lòng điền đầy đủ thông tin.';
            } elseif (!is_numeric($siso) || intval($siso) < 0) {
                $errors[] = 'Sĩ số phải là số nguyên dương.';
            } else {
                $lopModel->updateLop($id, $tenlop, $khoa, intval($siso));
                header('Location: index.php?url=lop/index');
                exit();
            }
        }

        $this->view('lop/edit', [
            'title' => 'Sửa lớp học',
            'errors' => $errors,
            'lop' => $lop,
        ]);
    }

    public function delete($id = null) {
        $lopModel = $this->model('LopModel');
        $id = intval($id);
        if ($id > 0) {
            $lopModel->deleteLop($id);
        }
        header('Location: index.php?url=lop/index');
        exit();
    }
}
