<h2>Search Results</h2>

<?php if (empty($students)): ?>
    <p>No student found.</p>
<?php else: ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>University</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student->ID) ?></td>
                <td><?= htmlspecialchars($student->NAME) ?></td>
                <td><?= htmlspecialchars($student->AGE) ?></td>
                <td><?= htmlspecialchars($student->UNIVERSITY) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<br>
<a href="./index.php">Back to list</a>
