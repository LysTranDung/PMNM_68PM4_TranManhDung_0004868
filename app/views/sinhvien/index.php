<<<<<<< HEAD
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
    table {
    border-collapse: collapse;
    width: 100%;
    }

    th, td {
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
    background-color: #04AA6D;
    color: white;
    }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>MSSV</th>
            <th>Giới tính</th>
        </tr>
        <?php foreach ($sinhviens as $index => $sinhvien): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $sinhvien['hoten']; ?></td>
                <td><?php echo $sinhvien['mssv']; ?></td>
                <td><?php echo $sinhvien['gioitinh']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
=======
<?php
?>

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Danh Sách Sinh Viên</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Mã Sinh Viên</th>
                        <th>Họ Tên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Lớp</th>
                        <th>Ngành Học</th>
                        <th>Ngày Sinh</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>SV001</td>
                        <td>Nguyễn Quốc Việt</td>
                        <td>viet.nguyen@example.com</td>
                        <td>0912345678</td>
                        <td>12CT1</td>
                        <td>Công Nghệ Thông Tin</td>
                        <td>15/05/2004</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Sửa</button>
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>SV002</td>
                        <td>Trần Thị Hương</td>
                        <td>huong.tran@example.com</td>
                        <td>0987654321</td>
                        <td>12CT1</td>
                        <td>Công Nghệ Thông Tin</td>
                        <td>22/08/2004</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Sửa</button>
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>SV003</td>
                        <td>Phạm Văn Nam</td>
                        <td>nam.pham@example.com</td>
                        <td>0934567890</td>
                        <td>12CT2</td>
                        <td>Công Nghệ Thông Tin</td>
                        <td>10/03/2004</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Sửa</button>
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>SV004</td>
                        <td>Hoàng Thị Lan</td>
                        <td>lan.hoang@example.com</td>
                        <td>0956789012</td>
                        <td>12CT2</td>
                        <td>Công Nghệ Thông Tin</td>
                        <td>28/11/2003</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Sửa</button>
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>SV005</td>
                        <td>Lê Minh Duy</td>
                        <td>duy.le@example.com</td>
                        <td>0978901234</td>
                        <td>12CT3</td>
                        <td>Công Nghệ Thông Tin</td>
                        <td>05/07/2004</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Sửa</button>
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <button class="btn btn-success">+ Thêm Mới</button>
        </div>
    </div>
</div>
>>>>>>> f36696361597fc57af1d538b401e57fe9cb24167
