<?php
include "config.php";

$selected_category = $_GET['category'] ?? '';
$selected_price = $_GET['price'] ?? '';

$cateQuery = mysqli_query($connect, "SELECT * FROM categories");
?>
<link rel="stylesheet" href="css/sidebar.css">

<form method="GET" action="categories.php" id="filter-form" class="filter-sidebar">
<div class="categories-select">
    <h3>Thể loại</h3>
    <label>
        <input type="radio" name="category" value="" <?= ($selected_category == '') ? 'checked' : '' ?>>
            Tất cả sản phẩm
    </label><br>

    <?php while ($row = mysqli_fetch_assoc($cateQuery)): ?>
        <label>
            <input type="radio" name="category" value="<?= $row['category_id'] ?>"
                <?= ($selected_category == $row['category_id']) ? 'checked' : '' ?>>
            <?= htmlspecialchars($row['category_name']) ?>
        </label><br>
    <?php endwhile; ?>
</div>

    <h3>Giá</h3>
    <label>
        <input type="radio" name="price" value="" <?= ($selected_price == '') ? 'checked' : '' ?>>
            Mọi mức giá
    </label><br>

    <?php
    $prices = [
        "0-50000" => "0đ - 50.000đ",
        "50000-100000" => "50.000đ - 100.000đ",
        "100000-150000" => "100.000đ - 150.000đ",
        "150000-200000" => "150.000đ - 200.000đ"
    ];
    foreach ($prices as $key => $label):
        $checked = ($selected_price === $key) ? 'checked' : '';
    ?>
    <label><input type="radio" name="price" value="<?= $key ?>" <?= $checked ?>> <?= $label ?></label><br>
    <?php endforeach; ?>
</form>
<script>
    const filterForm = document.getElementById('filter-form');
    filterForm.addEventListener('change', function () {
    this.submit();
    });
</script>