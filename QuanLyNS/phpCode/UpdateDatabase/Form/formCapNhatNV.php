<?php
require_once(__DIR__ . "/../../DB/connectDatabase.php");

// Lấy danh sách IDPB để làm dropdown
$query = "SELECT IDPB FROM PhongBan";
$resultPB = $conn->query($query);
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-semibold mb-4">Cập Nhật Thông Tin Nhân Viên</h2>

    <form action="../Xuli/XuliCapNhatNV.php" method="POST" class="space-y-4 bg-white p-4 rounded shadow-md">

        <input type="hidden" name="idNV" value="<?= htmlspecialchars($nhanvien['IDNV']) ?>">

        <div>
            <label class="block font-medium">Mã nhân viên</label>
            <input type="text" value="<?= htmlspecialchars($nhanvien['IDNV']) ?>" 
                   disabled class="border rounded px-3 py-2 w-full bg-gray-100 cursor-not-allowed">
        </div>

        <div>
            <label for="tenNV" class="block font-medium">Họ tên</label>
            <input type="text" id="tenNV" name="tenNV" 
                   value="<?= htmlspecialchars($nhanvien['Hoten']) ?>" 
                   required class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label for="diaChi" class="block font-medium">Địa chỉ</label>
            <input type="text" id="diaChi" name="diaChi" 
                   value="<?= htmlspecialchars($nhanvien['Diachi']) ?>" 
                   required class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label for="phongBan" class="block font-medium">Phòng ban (IDPB)</label>
            <select id="phongBan" name="phongBan" required class="border rounded px-3 py-2 w-full">
                <?php while ($row = $resultPB->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['IDPB']) ?>" 
                        <?= $row['IDPB'] === $nhanvien['IDPB'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['IDPB']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Cập Nhật
        </button>
    </form>
</div>
