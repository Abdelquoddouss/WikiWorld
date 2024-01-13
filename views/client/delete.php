<?php

    include __DIR__ . '/../../vendor/autoload.php';
    use app\controller\WikisController;
if (isset($_GET['id'])) {
    $delete = new WikisController();
    $delete->deletewiki($id);

    header("Location: http://localhost/WikiWorld/views/client/Wiki.php");
    exit;
} else {
    echo "Invalid request";
}
?>
