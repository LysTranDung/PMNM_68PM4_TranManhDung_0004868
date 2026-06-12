<?php
require_once __DIR__ . '/../core/DB.php';
class SinhvienModel {
    private $conn;

    public function __construct() {
        $this->conn = ConnectDB::Connect();
    }

    public function getAllSinhvien($search = '', $gender = '', $limit = 5, $offset = 0) {
        $where = 'WHERE 1=1';
        $params = [];

        if ($search !== '') {
            $where .= ' AND (s.hoten LIKE :search OR s.mssv LIKE :search OR l.tenlop LIKE :search)';
            $params[':search'] = '%' . $search . '%';
        }

        if ($gender !== '') {
            $where .= ' AND s.gioitinh = :gender';
            $params[':gender'] = $gender;
        }

        $order = 'ORDER BY s.id ASC';
        if (ConnectDB::getDriver() === 'sqlsrv') {
            $order .= ' OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY';
        } else {
            $order .= ' LIMIT :limit OFFSET :offset';
        }

        $query = "SELECT s.*, l.tenlop AS lop_ten FROM tbl_sinhviens s LEFT JOIN tbl_lops l ON s.lop_id = l.id {$where} {$order}";
        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSinhvienCount($search = '', $gender = '') {
        $where = 'WHERE 1=1';
        $params = [];

        if ($search !== '') {
            $where .= ' AND (hoten LIKE :search OR mssv LIKE :search)';
            $params[':search'] = '%' . $search . '%';
        }

        if ($gender !== '') {
            $where .= ' AND gioitinh = :gender';
            $params[':gender'] = $gender;
        }

        $query = "SELECT COUNT(*) AS total FROM tbl_sinhviens {$where}";
        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($result['total']);
    }

    public function getSinhvienById($id) {
        $query = 'SELECT * FROM tbl_sinhviens WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertSinhvien($hoten, $mssv, $gioitinh, $lop_id) {
        $query = 'INSERT INTO tbl_sinhviens (hoten, mssv, gioitinh, lop_id) VALUES (:hoten, :mssv, :gioitinh, :lop_id)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':hoten', $hoten, PDO::PARAM_STR);
        $stmt->bindValue(':mssv', $mssv, PDO::PARAM_STR);
        $stmt->bindValue(':gioitinh', $gioitinh, PDO::PARAM_STR);
        $stmt->bindValue(':lop_id', $lop_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateSinhvien($id, $hoten, $gioitinh, $lop_id) {
        $query = 'UPDATE tbl_sinhviens SET hoten = :hoten, gioitinh = :gioitinh, lop_id = :lop_id WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':hoten', $hoten, PDO::PARAM_STR);
        $stmt->bindValue(':gioitinh', $gioitinh, PDO::PARAM_STR);
        $stmt->bindValue(':lop_id', $lop_id, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteSinhvien($id) {
        $query = 'DELETE FROM tbl_sinhviens WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>