<?php
declare(strict_types=1);

require __DIR__ . '/includes/database.php';
require __DIR__ . '/classes/Club.php';

$club= null;

// $clubsListed = getClubs();


 function getClubs(PDO $db, int $user_id) : ?Club
    {
        $sql = "SELECT clubs.club_id, clubs.club_name, clubs.description, clubs.meeting_time, clubs.meeting_location, clubs.contact_email, clubs.category_id, categories.category_name
    FROM clubs
    JOIN categories
    ON clubs.category_id = categories.category_id
   WHERE clubs.club_id = $user_id ";


    $statement = $db->query($sql);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return Club::fromRow($row);
    }

    // $clubs = getClubs($db);
    $user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $club = null;
    $error ='';

if ($user_id === false || $user_id === null) {
    $error = 'Choose a product from the list.';
} else {
    $club = getClubs($db, $user_id);
    if ($club === null) {
        $error = "No product has the ID $user_id.";
    }
}

    

?>

<!-- Print statmentes miles stone 3 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $club !== null ? htmlspecialchars($club->name) : 'Product' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            max-width: 40rem;
        }
    </style>
</head>

<body>
    <p><a href="clubs.php">&larr; All products</a></p>

    <?php if ($club !== null): ?>
        <h1><?= htmlspecialchars($club->name) ?></h1>
        <p><?= nl2br(htmlspecialchars($club->description)) ?></p>
    <?php else: ?>
        <p><?= htmlspecialchars($error ?? 'Choose a product from the list.') ?></p>
    <?php endif; ?>
</body>

</html>

