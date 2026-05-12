    <?php
    include("../../database/config.php");
    header("Content-Type: application/json");

    $query = "select e.*, o.org_logo, o.org_name from events e join organizations o ON e.org_id = o.org_id";
    $result = mysqli_query($conn, $query);

    $events = [];

    while($row = mysqli_fetch_assoc($result)){
        $events[] = $row;
    }

    echo json_encode($events);
    ?>
