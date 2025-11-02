<?php

require_once(__DIR__ . "/../../DB/connectDatabase.php");

// Lấy danh sách IDPB từ bảng PhongBan
$query = "SELECT IDPB FROM PhongBan";
$result = $conn->query($query);
?>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-semibold mb-4">Thêm Nhân Viên Mới</h2>

    <form action="../Xuli/XuliChen.php" method="POST" class="space-y-4 bg-white p-4 rounded shadow-md">

        <div>
            <label for="tenNV" class="block font-medium">Tên nhân viên</label>
            <input type="text" id="tenNV" name="tenNV" required class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label for="diaChi" class="block font-medium">Địa chỉ</label>
            <input type="text" id="diaChi" name="diaChi" required class="border rounded px-3 py-2 w-full">
        </div>

        <div>
            <label for="phongBan" class="block font-medium">Mã Phòng Ban (IDPB)</label>
            <select id="phongBan" name="phongBan" required class="border rounded px-3 py-2 w-full">
                <option value="">-- Chọn IDPB --</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['IDPB']) ?>">
                        <?= htmlspecialchars($row['IDPB']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Thêm Nhân Viên
        </button>
    </form>
</div>
