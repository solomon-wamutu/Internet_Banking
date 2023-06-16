<?php
$sel = "SELECT * FROM `ib_systemsettings`";
$stmt = $mysqli->prepare($sel);
$stmt->execute();
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    ?>
<footer class = "main-footer">
    <strong>&copy;2023-<?php echo date('Y');?></strong>
    All rights reserved.
    <div class = "float-right d-none d-sm-inline-block">
</div>
</footer>
<?php } ?>