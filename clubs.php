<?php

declare(strict_types=1);

require __DIR__ . '/includes/database.php';
require __DIR__ . '/classes/Club.php';

$club = null;

// $clubsListed = getClubs();


function getClubs(PDO $db)
{
    $sql = "SELECT clubs.club_id, clubs.club_name, clubs.description, clubs.meeting_time, clubs.meeting_location, clubs.contact_email, clubs.category_id, categories.category_name
    FROM clubs
    JOIN categories
    ON clubs.category_id = categories.category_id
    ORDER BY clubs.club_name;";


    $statement = $db->query($sql);
    $recordSet = $statement->fetchAll(PDO::FETCH_ASSOC);

    $clubs = [];
    foreach ($recordSet as $row) {
        $clubs[] = Club::fromRow($row);
    }

    return $clubs;
}

$clubs = getClubs($db);


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
    <h1>Clubs</h1>

    <table>
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
            <?php endforeach; ?>
        </tbody>


        <thead>
            <tr>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
             <?php foreach ($categories as $items): ?>
                <tr>
                    <td><?= htmlspecialchars($items['category_name']) ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>