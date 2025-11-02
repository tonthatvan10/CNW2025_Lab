<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    echo "<p class='text-red-500 font-semibold'>Bạn cần đăng nhập để truy cập chức năng này.</p>";
    return;
}

require_once(__DIR__ . "/../../DB/connectDatabase.php");

$sql = "SELECT IDNV, Hoten, Diachi, IDPB FROM nhanvien";
$result = mysqli_query($conn, $sql);
?>

<!-- ===== GIAO DIỆN DANH SÁCH ===== -->
<div class="space-y-6">
    <!-- Nút thêm và xóa nhiều -->
    <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-sm border">
        <a href="UpdateDatabase/Feature/chen.php"
           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Thêm Nhân Viên</a>

        <form id="bulkDeleteForm" action="UpdateDatabase/Feature/xoatatca.php" method="POST" onsubmit="return confirmBulkDelete()">
            <button id="deleteSelectedButton" type="submit" disabled
                class="px-4 py-2 bg-gray-400 text-white rounded-md cursor-not-allowed transition-all">
                Xóa Nhân Viên Đã Chọn (0)
            </button>
        </form>
    </div>

    <!-- Bảng dữ liệu -->
    <table class="min-w-full border bg-white">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllCheckbox"></th>
                <th>IDNV</th><th>Họ Tên</th><th>Địa Chỉ</th><th>IDPB</th><th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td>
                    <input type="checkbox" name="selected_nv[]" value="<?= htmlspecialchars($row['IDNV']) ?>"
                           form="bulkDeleteForm" class="nv-checkbox">
                </td>
                <td><?= htmlspecialchars($row['IDNV']) ?></td>
                <td><?= htmlspecialchars($row['Hoten']) ?></td>
                <td><?= htmlspecialchars($row['Diachi']) ?></td>
                <td><?= htmlspecialchars($row['IDPB']) ?></td>
                <td>
                    <a href="UpdateDatabase/Feature/capnhatNV.php?id=<?= urlencode($row['IDNV']) ?>">Sửa</a> |
                    <a href="UpdateDatabase/Feature/xoa.php?id=<?= urlencode($row['IDNV']) ?>" onclick="return confirm('Xóa nhân viên này?')">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
const selectAll = document.getElementById('selectAllCheckbox');
const checkboxes = document.querySelectorAll('.nv-checkbox');
const deleteBtn = document.getElementById('deleteSelectedButton');

function updateDeleteButton() {
    const checkedCount = document.querySelectorAll('.nv-checkbox:checked').length;
    deleteBtn.textContent = `Xóa Nhân Viên Đã Chọn (${checkedCount})`;

    if (checkedCount > 0) {
        deleteBtn.disabled = false;
        deleteBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
        deleteBtn.classList.add('bg-red-600', 'hover:bg-red-700');
    } else {
        deleteBtn.disabled = true;
        deleteBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
        deleteBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
    }
}

selectAll.addEventListener('change', () => {
    checkboxes.forEach(cb => cb.checked = selectAll.checked);
    updateDeleteButton();
});

checkboxes.forEach(cb => cb.addEventListener('change', updateDeleteButton));

function confirmBulkDelete() {
    const count = document.querySelectorAll('.nv-checkbox:checked').length;
    if (count === 0) {
        alert("Vui lòng chọn ít nhất một nhân viên.");
        return false;
    }
    return confirm(`Bạn có chắc muốn xóa ${count} nhân viên đã chọn?`);
}
</script>
