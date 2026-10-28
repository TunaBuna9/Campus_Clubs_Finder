<?php

declare(strict_types=1);

class Club
{
    public ?int $id;
    public string $name;
    public string $description;
    public string $meeting_time;
    public string $location;
    public string $email;

    public int $catagory_id;
    public string $catagory_name;

    public function __construct(
        string $name,
        string $description,
        string $meeting_time,
        string $location,
        string $email,
        int $catagory_id,
        string $catagory_name,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->meeting_time = $meeting_time;
        $this->location = $location;
        $this->email = $email;

        $this->catagory_id = $catagory_id;
        $this->catagory_name = $catagory_name;
    }

    public static function fromRow(array $row): Club
    {
        // BROKEN SECTION
        return new Club(
            $row['clubName'],
            $row['description'],
            $row['meetTime'],
            $row['clubLocation'],
            $row['clubEmail'],
            (int) $row['categoryId'],
            $row['category_name'],
            (int) $row['clubId']
        );
    }



   
    
}
