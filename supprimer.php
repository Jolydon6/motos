


<?php
require_once('config.php');
$id = (int) $_GET['id'];

$delete = $bdd-> prepare("DELETE FROM agent WHERE num_agent = ?");
$delete-> execute(array($id));
$sup = $delete->fetch();


if ($delete) {
    
    echo "<script>location.href = 'agent.php'</script>";
}

?>