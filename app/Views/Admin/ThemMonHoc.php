<?php
    $isEdit = isset($data['dataMH']);
    $mh = $isEdit ? $data['dataMH'] : null;
?>
<div class="qnu-form-container" style="max-width: 600px; margin: 40px auto; padding: 20px; border: 1px solid #dee2e6; border-radius: 8px; background-color: #f8f9fa; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    
    <h2 class="qnu-form-container__title" style="text-align: center; margin-bottom: 25px; color: #0d6efd; font-weight: bold;">
        <?= $isEdit ? 'SỬA MÔN HỌC' : 'THÊM MÔN HỌC MỚI' ?>
    </h2>

    <form class="qnu-course-form" method="post" >
        <div class="qnu-course-form__group" style="margin-bottom: 15px;">
            <label for="maMonHoc" class="qnu-course-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Mã môn học:</label>
            <input type="text" name="<?= $isEdit ? 'MaMonHoc' : 'MaMon' ?>" value="<?= $isEdit ? htmlspecialchars($mh['MaMonHoc']) : '' ?>" <?= $isEdit ? 'readonly' : '' ?> id="maMonHoc" class="form-control qnu-course-form__input" placeholder="Ví dụ: COMP123" style="border-color: #adb5bd;">
        </div>

        <div class="qnu-course-form__group" style="margin-bottom: 15px;">
            <label for="tenMonHoc" class="qnu-course-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Tên môn học:</label>
            <input type="text" name="<?= $isEdit ? 'TenMonHoc' : 'TenMon' ?>" value="<?= $isEdit ? htmlspecialchars($mh['TenMonHoc']) : '' ?>" id="tenMonHoc" class="form-control qnu-course-form__input" placeholder="Ví dụ: Lập trình Web" style="border-color: #adb5bd;">
        </div>

        <div class="qnu-course-form__group" style="margin-bottom: 15px;">
            <label for="soTinChi" class="qnu-course-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Số tín chỉ:</label>
            <input type="number" name="SoTC" value="<?= $isEdit ? htmlspecialchars($mh['SoTC']) : '' ?>" id="soTC" class="form-control qnu-course-form__input" min="1" max="10" style="border-color: #adb5bd;">
        </div>

        <div class="qnu-course-form__group" style="margin-bottom: 25px;">
            <label for="khoaPhuTrach" class="qnu-course-form__label" style="display: block; font-weight: 600; margin-bottom: 5px;">Khoa phụ trách:</label>
            <select name="<?= $isEdit ? 'KhoaPhuTrach' : 'MaKhoa' ?>" id="khoaPhuTrach" class="form-select qnu-course-form__select" style="border-color: #adb5bd; cursor: pointer;">
                <option selected disabled>-- Chọn khoa --</option>
                <?php foreach ($data['listKhoa'] as $khoa): ?>
                    <option value="<?= $khoa['MaKhoa'] ?>" <?= ($isEdit && $khoa['MaKhoa'] == $mh['KhoaPhuTrach']) ? 'selected' : '' ?>><?= $khoa['TenKhoa'] ?></option>
                <?php endforeach; ?>    
                <!-- <option value="CNTT">Khoa Công nghệ thông tin</option>
                <option value="TOAN">Khoa Toán & Thống kê</option>
                <option value="KT">Khoa Kinh tế & QTKD</option>
                <option value="NN">Khoa Ngoại ngữ</option> -->
            </select>
        </div>

        <div class="qnu-course-form__actions" style="display: flex; gap: 10px; justify-content: flex-end;">
            <a href="Admin/QuanLyDiemDanh/MonHoc" class="btn btn-secondary qnu-course-form__button--reset" style="padding: 8px 20px; text-decoration: none; color: white; background-color: #6c757d;">Hủy</a>
            <button type="submit" class="btn btn-primary qnu-course-form__button--submit" style="padding: 8px 25px; background-color: #0d6efd; border: none;"><?= $isEdit ? 'Cập nhật' : 'Lưu môn học' ?></button>
        </div>
    </form>
</div>