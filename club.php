<?php

declare(strict_types=1);

require __DIR__ . '/includes/database.php';
require __DIR__ . '/classes/Club.php';

$club = null;

// $clubsListed = getClubs();


function getClubs(PDO $db, int $user_id): ?Club
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
$error = '';

if ($user_id === null || $user_id === false || $user_id === 0) {
    $error = "Sorry, that's not a valid club, please try your search again or select an item from the Clubs List";
}
// elseif ($user_id = $club){
//      $error = "Sorry, there's no club with that ID yet, please try your search again or select an item from the Clubs List";
// }

else {
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
    <?php include 'includes/header.php' ?>
</head>

<body>
    <?php include 'includes/navigation.php' ?>
    <main class="container-fluid">
        <div class="table-borders p-3 club-pad">

            <div class="row">
                <div class="  col-sm-12 col-lg-8">
                    <p><a href="clubs.php"><i class="fa-solid fa-arrow-left-long"></i> Back to Clubs List</a></p>

                    <p class="card-text"> <?php if ($club !== null): ?>

                    <h1><?= htmlspecialchars($club->name) ?></h1>
                    <p class="text-secondary"><?= nl2br(htmlspecialchars($club->catagory_name)) ?></p>
                    <p class="ps-3 pe-3"><?= nl2br(htmlspecialchars($club->description)) ?></p>
                    <p><b>When:</b> <?= nl2br(htmlspecialchars($club->meeting_time)) ?></p>
                    <p><b>Where:</b> <?= nl2br(htmlspecialchars($club->location)) ?></p>



                    <p>For more details or questions, contact 

                        <a href= "mailto:<?= nl2br(htmlspecialchars($club->email)) ?>"><?= nl2br(htmlspecialchars($club->email)) ?></a>

                    </p>
                <?php else: ?>
                    <p><?= htmlspecialchars($error ?? "Sorry, that club couldn't be found.") ?></p>


                <?php endif; ?></p>


                </div>
                <div class="col-sm-12 col-lg-4">
                    <div class="card">
                        <img src="images/campus.jpg" class="card-img" alt="Campus building">

                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>

</html>