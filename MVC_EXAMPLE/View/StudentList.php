<h2>Student List</h2>

<!-- ===== Form tìm kiếm ===== -->
<form method="POST" action="?action=search" style="margin-bottom: 20px;">
    <input type="text" name="ID" placeholder="Search by ID">
    <input type="text" name="NAME" placeholder="Search by Name">
    <input type="text" name="UNIVERSITY" placeholder="Search by University">
    <input type="submit" value="Search">
    <a href="./index.php">Reset</a>
</form>

<!-- ===== Danh sách sinh viên ===== -->
<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>University</th>
        <th>Action</th>
    </tr>

    <?php if (!empty($students)): ?>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student->ID) ?></td>
                <td><?= htmlspecialchars($student->NAME) ?></td>
                <td><?= htmlspecialchars($student->AGE) ?></td>
                <td><?= htmlspecialchars($student->UNIVERSITY) ?></td>
                <td>
                    <a href="?action=update&ID=<?= $student->ID ?>">Edit</a> |
                    <a href="?action=delete&ID=<?= $student->ID ?>" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5">No students found.</td></tr>
    <?php endif; ?>
</table>

<br>
<a href="?action=add">➕ Add New Student</a>
