<?php
require_once __DIR__ . '/../core/DB.php';

class LopModel {
    private $conn;

    public function __construct() {
        $this->conn = ConnectDB::Connect();
    }

    public function getAllLop($search = '', $limit = 5, $offset = 0) {
        $where = 'WHERE 1=1';
        $params = [];

        if ($search !== '') {
            $where .= ' AND (tenlop LIKE :search OR khoa LIKE :search)';
            $params[':search'] = '%' . $search . '%';
        }

        $order = 'ORDER BY id ASC';
        if (ConnectDB::getDriver() === 'sqlsrv') {
            $order .= ' OFFSET :offset ROWS FETCH NEXT :limit ROWS ONLY';
        } else {
            $order .= ' LIMIT :limit OFFSET :offset';
        }

        $query = "SELECT * FROM tbl_lops {$where} {$order}";
        $stmt = $this->conn->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLopCount($search = '') {
        $where = 'WHERE 1=1';
        $params = [];

        if ($search !== '') {
            $where .= ' AND (tenlop LIKE :search OR khoa LIKE :search)';
            $params[':search'] = '%' . $search . '%';
        }

        $query = "SELECT COUNT(*) AS total FROM tbl_lops {$where}";
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($result['total']);
    }

    public function getLopById($id) {
        $query = 'SELECT * FROM tbl_lops WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertLop($tenlop, $khoa, $siso) {
        $query = 'INSERT INTO tbl_lops (tenlop, khoa, siso) VALUES (:tenlop, :khoa, :siso)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':tenlop', $tenlop, PDO::PARAM_STR);
        $stmt->bindValue(':khoa', $khoa, PDO::PARAM_STR);
        $stmt->bindValue(':siso', $siso, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateLop($id, $tenlop, $khoa, $siso) {
        $query = 'UPDATE tbl_lops SET tenlop = :tenlop, khoa = :khoa, siso = :siso WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':tenlop', $tenlop, PDO::PARAM_STR);
        $stmt->bindValue(':khoa', $khoa, PDO::PARAM_STR);
        $stmt->bindValue(':siso', $siso, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteLop($id) {
        $query = 'DELETE FROM tbl_lops WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllLopList() {
        $query = 'SELECT id, tenlop FROM tbl_lops ORDER BY tenlop ASC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
