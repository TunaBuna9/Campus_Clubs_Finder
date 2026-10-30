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
if ($clubs == null) {
    $noClubs = "We're sorry, there are no clubs availiable at the moment for NAME INSERT ";
    //. $categories['category_name;']

}


if ($categoryId === false || $categoryId === null) {
    $error = "Sorry, there's no club that matches that search, please try again or see below for all available clubs! ";
    echo $error;
} else {
    $categoryId = getClubs($db, $categoryId);
}

?>

<!-- Print statmentes miles stone 3 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #adb5bd;
            padding: 0.4rem 0.8rem;
            text-align: left;
        }

        th {
            background: #343a40;
            color: #fff;
        }
    </style>
</head>

<body>
    <h1> Clubs</h1>

    <table>
        <?php echo htmlspecialchars($noClubs);
        if ($clubs == !null) { ?>
            <thead>
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
                        <td><?= htmlspecialchars($club->catagory_name) ?></td>
                        <td><?= htmlspecialchars($club->meeting_time) ?></td>

                    </tr>
            <?php endforeach;
            } ?>
            </tbody>
    </table>
    <br>


    <br>

    <form action="" method="GET">
        <label for="club_type">Select the club type you'd like to see:</label>
        <br>
        <select name="category_id" id="select_club_type">
            <!-- All choices -->
            <option value="0">All Club Types</option> <!-- Database options -->
            <?php foreach ($categories as $items): ?>
                <option value="<?= (int) $items['category_id'] ?>"
                    <?= (int) $items['category_id'] === $categoryId ? 'selected' : '' ?>>
                    <?= htmlspecialchars($items['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" value="Search Clubs">
    </form>
</body>

</html>