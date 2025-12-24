<?php
    $lopHP = $data['dataLopHP'] ?? null;
    $isEdit = !empty($lopHP);
?>
<div class="qnu-form-container" style="max-width: 700px; margin: 40px auto; padding: 25px; border: 1px solid #dee2e6; border-radius: 8px; background-color: #ffffff; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    
    <h2 class="qnu-form-container__title" style="text-align: center; margin-bottom: 30px; color: #198754; font-weight: bold;">
        <?= $isEdit ? 'CẬP NHẬT LỚP HỌC PHẦN' : 'TẠO LỚP HỌC PHẦN MỚI' ?>
    </h2>

    <form class="qnu-class-form" action="" method="POST">
        
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-6">
                <div class="qnu-class-form__group">
                    <label for="maLopHP" class="qnu-class-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Mã lớp HP:</label>
                    <input type="text" id="maLopHP" name="MaLHP" class="form-control qnu-class-form__input" placeholder="VD: 2025_COMP123_01" required style="border-color: #ced4da;" value="<?= $lopHP['MaLHP'] ?? '' ?>" <?= $isEdit ? 'readonly' : '' ?>>
                </div>
            </div>
        </div>

        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-6">
                <div class="qnu-class-form__group">
                    <label for="giangVien" class="qnu-class-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Giảng viên:</label>
                    <select id="giangVien" name="MaGiangVien" class="form-select qnu-class-form__select" required style="border-color: #ced4da; cursor: pointer;">
                        <option value="" selected disabled>-- Chọn giảng viên --</option>
                        <?php foreach($data['listGiangVien'] as $gv): ?>
                            <option value="<?= $gv['MaGV'] ?>" <?= ($lopHP['MaGiangVien'] ?? '') == $gv['MaGV'] ? 'selected' : '' ?>><?= $gv['Ho'] . ' ' . $gv['Ten'] ?></option>
                        <?php endforeach; ?>
                        <!-- <option value="GV001">ThS. Nguyễn Văn A</option>
                        <option value="GV002">TS. Trần Thị B</option>
                        <option value="GV003">ThS. Lê Văn C</option> -->
                    </select>
                </div>
            </div>
                <div class="col-md-6">
                <div class="qnu-class-form__group">
                    <label for="monHoc" class="qnu-class-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Môn học:</label>
                    <select id="monHoc" name="MaMonHoc" class="form-select qnu-class-form__select" required style="border-color: #ced4da; cursor: pointer;">
                        <option value="" selected disabled>-- Chọn môn học --</option>
                        <?php foreach($data['listMonHoc'] as $mh): ?>
                            <option value="<?= $mh['MaMonHoc'] ?>" <?= ($lopHP['MaMonHoc'] ?? '') == $mh['MaMonHoc'] ? 'selected' : '' ?>><?= $mh['TenMonHoc'] ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="qnu-class-form__group">
                    <label for="hocKy" class="qnu-class-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Học kỳ:</label>
                    <select id="hocKy" name="MaHocKy" class="form-select qnu-class-form__select" required style="border-color: #ced4da; cursor: pointer;">
                        <option value="" selected disabled>-- Chọn học kỳ --</option>
                        <?php foreach($data['listHocKy'] as $hk): ?>
                            <option value="<?= $hk['MaHK'] ?>" <?= ($lopHP['MaHocKy'] ?? '') == $hk['MaHK'] ? 'selected' : '' ?>><?= $hk['TenHK'] ?></option> 
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row" style="margin-bottom: 25px;">
            <div class="col-md-6">
                <div class="qnu-class-form__group">
                    <label for="thoiGianBatDau" class="qnu-class-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Thời gian bắt đầu:</label>
                    <input type="date" id="thoiGianBatDau" name="ThoiGianBatDau" class="form-control qnu-class-form__input" required style="border-color: #ced4da;" value="<?= $lopHP['ThoiGianBatDau'] ?? '' ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="qnu-class-form__group">
                    <label for="thoiGianKetThuc" class="qnu-class-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Thời gian kết thúc:</label>
                    <input type="date" id="thoiGianKetThuc" name="ThoiGianKetThuc" class="form-control qnu-class-form__input" required style="border-color: #ced4da;" value="<?= $lopHP['ThoiGianKetThuc'] ?? '' ?>">
                </div>
            </div>
        </div>

        <div class="qnu-class-form__actions" style="display: flex; gap: 10px; justify-content: center; margin-top: 10px;">
            <button type="reset" class="btn btn-outline-secondary qnu-class-form__button--reset" style="padding: 10px 30px;">Làm mới</button>
            <button type="submit" class="btn btn-success qnu-class-form__button--submit" style="padding: 10px 40px; font-weight: 600;"><?= $isEdit ? 'Cập nhật' : 'Tạo lớp học phần' ?></button>
        </div>

    </form>
</div>