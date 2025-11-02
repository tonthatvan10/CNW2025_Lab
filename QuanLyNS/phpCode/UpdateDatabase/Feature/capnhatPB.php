<?php
require_once(__DIR__ . "/../../DB/connectDatabase.php");
?>

<div class="space-y-6">
    <h3 class="text-xl font-semibold text-gray-700">Cập Nhật Phòng Ban</h3>

    <form action="UpdateDatabase/Xuli/XuliCapNhatPB.php" method="POST" class="bg-gray-50 p-6 rounded-lg shadow">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">ID Phòng Ban</label>
                <input type="text" name="IDPB" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-indigo-200" placeholder="VD: PB01">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Tên Phòng Ban</label>
                <input type="text" name="Tenpb" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-indigo-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Mô tả</label>
                <input type="text" name="Mota" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-indigo-200">
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Cập Nhật
            </button>
        </div>
    </form>

    <div class="mt-10">
        <h4 class="text-lg font-semibold text-gray-700 mb-3">Danh sách Phòng Ban</h4>
        <?php
        $sql = "SELECT * FROM PHONGBAN";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='w-full border border-gray-200 text-sm text-left'>";
            echo "<thead class='bg-gray-100'><tr>
                    <th class='p-2 border'>IDPB</th>
                    <th class='p-2 border'>Tên Phòng Ban</th>
                    <th class='p-2 border'>Mô Tả</th>
                </tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td class='border p-2'>{$row['IDPB']}</td>
                        <td class='border p-2'>{$row['Tenpb']}</td>
                        <td class='border p-2'>{$row['Mota']}</td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='text-gray-500 italic'>Chưa có dữ liệu phòng ban.</p>";
        }
        ?>
    </div>
</div>
