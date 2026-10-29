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
        // Names must match colums in table, or it errors - That's why it wouldn't work
        return new Club(
            $row['club_name'], //Broken
            $row['description'],
            $row['meeting_time'],
            $row['meeting_location'], //Broken
            $row['contact_email'],  //Broken
            (int) $row['category_id'],
            $row['category_name'],
            (int) $row['club_id'] //Broken
        );
    }
    
}

 
