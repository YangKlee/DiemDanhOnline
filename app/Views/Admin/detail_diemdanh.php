<div  id="modalDetail">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Chi tiết điểm danh — <span id="detailHeader"></span>
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- THANH TÌM KIẾM SINH VIÊN -->
                <input id="searchStudent" class="form-control mb-3" placeholder="Tìm sinh viên...">

                <div class="table-responsive">
                    <table class="table table-bordered" id="tableDetail">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px">STT</th>
                                <th>Mã sinh viên</th>
                                <th>Tên sinh viên</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['dataPhienDD'] as $index => $ctdd): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($ctdd['MSSV']) ?></td>
                                <td><?= htmlspecialchars($ctdd['TenSinhVien']) ?></td>
                                <td>
                                    <?php if($ctdd['TrangThai'] == 1): ?>
                                        <span class="badge bg-success">Có mặt</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Vắng mặt</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $ctdd['ThoiGian']?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        
                    </table>
                </div>

            </div>

            <div class="modal-footer">
                <div class="me-auto small-muted" id="countInfo"></div>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>