-- CIS239: Campus Club Finder
-- Fictional clubs and sample contact addresses.
-- Import into MySQL. This script creates the database, tables, and records.
-- Existing tables are not dropped or overwritten.

CREATE DATABASE IF NOT EXISTS campus_clubs
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE campus_clubs;

CREATE TABLE categories (
    category_id INT NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    PRIMARY KEY (category_id)
) ENGINE=InnoDB;

CREATE TABLE clubs (
    club_id INT NOT NULL AUTO_INCREMENT,
    club_name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    meeting_time VARCHAR(100) NOT NULL,
    meeting_location VARCHAR(100) NOT NULL,
    contact_email VARCHAR(150) NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (club_id),
    CONSTRAINT fk_clubs_categories FOREIGN KEY (category_id)
        REFERENCES categories (category_id)
) ENGINE=InnoDB;

INSERT INTO categories (category_id, category_name) VALUES
    (1, 'Technology'),
    (2, 'Arts & Creativity'),
    (3, 'Service & Community'),
    (4, 'Games & Recreation'),
    (5, 'Science & Nature');

-- Science & Nature intentionally has no clubs for empty-results testing.
INSERT INTO clubs
    (club_id, club_name, description, meeting_time, meeting_location, contact_email, category_id)
VALUES
    (1, 'Code Collective',
     'Build small apps, trade debugging tips, and tackle coding challenges with other students. All experience levels are welcome.',
     'Tuesdays at 3:00 PM', 'Technology Center, Room 201', 'codecollective@example.com', 1),
    (2, 'Makers & Motors',
     'Experiment with robotics, electronics, and 3D printing. Bring your curiosity and work with a team to turn ideas into working projects.',
     'Thursdays at 4:00 PM', 'Innovation Lab, Room 105', 'makers@example.com', 1),
    (3, 'Shutter Squad',
     'Explore photography through campus photo walks and creative challenges. A phone camera is all you need to get started.',
     'Wednesdays at 2:00 PM', 'Arts Building, Room 112', 'shuttersquad@example.com', 2),
    (4, 'The Writer''s Room',
     'Share stories, poetry, and creative ideas in a welcoming workshop. Try writing prompts and offer constructive feedback on each other''s work.',
     'Mondays at 3:30 PM', 'Library, Room 204', 'writersroom@example.com', 2),
    (5, 'Campus Kindness Crew',
     'Plan donation drives, volunteer projects, and small acts of kindness. Help make campus and the surrounding community a better place.',
     'Tuesdays at 12:30 PM', 'Student Center, Room 101', 'kindnesscrew@example.com', 3),
    (6, 'Community Table',
     'Support local food programs through collection events and volunteer opportunities. Connect with students who want to help neighbors facing food insecurity.',
     'Fridays at 1:00 PM', 'Student Center, Room 103', 'communitytable@example.com', 3),
    (7, 'Critical Hit Club',
     'Discover board games and tabletop adventures with fellow students. Learn a new game or bring a favorite to share with the group.',
     'Thursdays at 3:30 PM', 'Student Lounge', 'criticalhit@example.com', 4),
    (8, 'Trail & Trek',
     'Meet other students who enjoy walking and exploring local trails. Plan group outings and share ideas for affordable outdoor adventures.',
     'Wednesdays at 4:00 PM', 'Recreation Center Lobby', 'trailandtrek@example.com', 4);
