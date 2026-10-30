<?php

declare(strict_types=1);

require __DIR__ . '/includes/database.php';
require __DIR__ . '/classes/Club.php';

$club = null;
$categoryId = 0;

if ($_GET) {
    $categoryId = filter_input(INPUT_GET, "category_id", FILTER_VALIDATE_INT) ?? 0;
}

// Adding type, doesn't all for other null options
function getClubs(PDO $db, $categoryId)
{
    $sql = "";

    if ($categoryId == 0 || $categoryId == null ||  $categoryId == "") {
        $sql = "SELECT clubs.club_id, clubs.club_name, clubs.description, clubs.meeting_time, clubs.meeting_location, clubs.contact_email, clubs.category_id, categories.category_name
        FROM clubs
        JOIN categories
        ON clubs.category_id = categories.category_id 
        ORDER BY clubs.club_name;";
    } else {
        $sql = "SELECT clubs.club_id, clubs.club_name, clubs.description, clubs.meeting_time, clubs.meeting_location, clubs.contact_email, clubs.category_id, categories.category_name
        FROM clubs
        JOIN categories
        ON clubs.category_id = categories.category_id 
        WHERE categories.category_id = $categoryId
        ORDER BY clubs.club_name;";
    }

    $statement = $db->query($sql);
    $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

    $clubs = [];
    foreach ($recordSet as $row) {
        $clubs[] = Club::fromRow($row);
    }

    return $clubs;
}

$clubs = getClubs($db, $categoryId);


function getCategories(PDO $db)
{
    $sql = "SELECT categories.category_id, categories.category_name FROM categories ORDER BY categories.category_name;";

    $statement = $db->query($sql);
    $recordSet2 = $statement->fetchAll(PDO::FETCH_ASSOC);
    $categories = [];

    foreach ($recordSet2 as $row) {
        $categories[] = ($row);
    }
    return ($categories);
}

$categories = getCategories($db);


$noClubs = "";
$spacer="";
$spacer2="";
if ($clubs == null) {
    $noClubs = "We're sorry, there are no clubs availiable at the moment for NAME INSERT ";
    //. $categories['category_name;']
    $spacer="<br>";
$spacer2="...";


}

$error="";
if ($categoryId === false || $categoryId === null) {
    $error = "Sorry, there's no club that matches that search.. <br> Please try again or see above for all available clubs! ";
    
} else {
    $categoryId = getClubs($db, $categoryId);
}

?>

<!-- Print statmentes miles stone 3 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Greenfeild Clubs</title>
    <?php include 'includes/header.php' ?>
</head>

<body>
    <?php include 'includes/navigation.php' ?>


    <main class="container-fluid mb-3">
        <h1 class="text-center mt-3 mb-3 fw-bold"> Clubs</h1>
        
        <div class=table-borders>
            <p class="text-center m-0"><?php echo $spacer . htmlspecialchars($noClubs) . $spacer . $spacer2; ?></p>
            <table class="table table-striped mb-0">
                
                <?php if ($clubs == !null) { ?>
                    <thead class="table-success">
                        <tr>
                            <th>Club</th>
                            <th>Category</th>
                            <th>Meet Times</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clubs as $club): ?>
                            <tr>
                                <td><a href="club.php?id=<?= (int) $club->id ?>"><?= htmlspecialchars($club->name) ?></a></td>
                                <td class="column"><?= htmlspecialchars($club->catagory_name) ?></td>
                                <td class="column"><?= htmlspecialchars($club->meeting_time) ?></td>

                            </tr>
                    <?php endforeach;
                    } ?>
                    </tbody>
            </table>
        </div>

        <br>

        <div class="table-borders text-center filter-box">
            <h2 class="mt-3 mb-3 fw-bold">Filter by club type</h2>

            <form action="" method="GET">
                <label for="category_id">
                    <p>Select a category:</p>
                </label>
                <select name="category_id" id="category_id">
                    <!-- All choices -->
                    <option value="0">All Club Types</option> <!-- Database options -->
                    <?php foreach ($categories as $items): ?>
                        <option value="<?= (int) $items['category_id'] ?>"
                            <?= (int) $items['category_id'] === $categoryId ? 'selected' : '' ?>>
                            <?= htmlspecialchars($items['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>
                <button class="subButton" type="submit">Search Clubs</button>
            </form>

            <!-- FINISH ERROR DESIGN -->
            <?php if ($error){echo $error;}?>

        </div>




    </main>

</body>

</html>