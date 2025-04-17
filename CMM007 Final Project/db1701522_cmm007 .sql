-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 12:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db1701522_cmm007`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookcovers`
--

CREATE TABLE `bookcovers` (
  `imgID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `imagePath` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookcovers`
--

INSERT INTO `bookcovers` (`imgID`, `bookID`, `imagePath`) VALUES
(3, 15, '67fbdeb81ecc8.jpeg'),
(4, 16, '67fe87a06fc15.jpg'),
(6, 35, '67feb9646fbc0.jpg'),
(7, 36, '67feb9e8a98ae.jpg'),
(8, 37, '67feba5f8eca7.png'),
(9, 38, '67febb2b663d3.jpg'),
(10, 39, '67febbd720b0d.png'),
(11, 40, '67febc89e8f3d.png'),
(12, 41, '67febd36b814e.png'),
(13, 42, '67febdc0a9a70.jpg'),
(14, 43, '67febed48cf33.png'),
(15, 44, '67febf790ce4b.jpg'),
(16, 45, '67febfbfe19f1.jpg'),
(17, 46, '67fec0286a4e3.png'),
(18, 47, '67fec09dd4fc7.png'),
(19, 48, '67fec1088284b.jpg'),
(21, 50, '67fede55231a1.jpg'),
(22, 51, '67ffeabdb55d8.jpg'),
(23, 52, '68002a95d06ef.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookreservation`
--

CREATE TABLE `bookreservation` (
  `reservationID` int(4) NOT NULL,
  `bookID` int(4) UNSIGNED NOT NULL,
  `reservationEmail` varchar(75) NOT NULL,
  `reservationDate` date NOT NULL DEFAULT current_timestamp(),
  `returnDate` date GENERATED ALWAYS AS (`reservationDate` + interval 1 month) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `bookCover` varchar(50) NOT NULL,
  `author` varchar(200) NOT NULL,
  `isbn` int(13) NOT NULL,
  `quantity` int(3) NOT NULL,
  `description` text NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `uploadDate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `title`, `bookCover`, `author`, `isbn`, `quantity`, `description`, `genre`, `uploadDate`) VALUES
(16, 'Sunrise on the Reaping - The Hunger Games', '', 'Suzanne Collins', 2147483647, 2, 'When you\'ve been set up to lose everything you love, what is there left to fight for?\r\n\r\nAs the day dawns on the fiftieth annual Hunger Games, fear grips the districts of Panem. This year, in honour of the Quarter Quell, twice as many tributes will be taken from their homes.\r\n\r\nBack in District 12, Haymitch Abernathy is trying not to think too hard about his chances. All he cares about is making it through the day and being with the girl he loves.\r\n\r\nWhen Haymitch\'s name is called, he can feel all his dreams break. He\'s torn from his family and his love, shuttled to the Capitol with the three other District 12 tributes: a young friend who\'s nearly a sister to him, a compulsive oddsmaker, and the most stuck-up girl in town.\r\n\r\nAs the Games begin, Haymitch understands he\'s been set up to fail. But there\'s something in him that wants to fight... and have that fight reverberate far beyond the deadly arena.', 'action', '2025-04-15'),
(35, 'Butter', '', 'Asako Yuzuki', 2147483647, 2, 'The cult Japanese bestseller about a female gourmet cook and serial killer and the journalist intent on cracking her case, inspired by a true story.\r\n\r\nThere are two things that I can simply not tolerate: feminists and margarine\r\n\r\nGourmet cook Manako Kajii sits in Tokyo Detention Centre convicted of the serial murders of lonely businessmen, who she is said to have seduced with her delicious home cooking. The case has captured the nation\'s imagination but Kajii refuses to speak with the press, entertaining no visitors. That is, until journalist Rika Machida writes a letter asking for her recipe for beef stew and Kajii can\'t resist writing back.\r\n\r\nRika, the only woman in her news office, works late each night, rarely cooking more than ramen. As the visits unfold between her and the steely Kajii, they are closer to a masterclass in food than journalistic research. Rika hopes this gastronomic exchange will help her soften Kajii but it seems that she might be the one changing. With each meal she eats, something is awakening in her body, might she and Kaji have more in common than she once thought?\r\n\r\nInspired by the real case of the convicted con woman and serial killer, \"The Konkatsu Killer\", Asako Yuzuki\'s Butter is a vivid, unsettling exploration of misogyny, obsession, romance and the transgressive pleasures of food in Japan.', 'thriller', '2025-04-15'),
(36, 'Fourth Wing', '', 'Rebecca Yarros', 2147483647, 1, 'Welcome to the brutal and elite world of Basgiath War College, where everyone has an agenda, and every night could be your last...\r\n\r\nTwenty-year-old Violet Sorrengail was supposed to enter the Scribe Quadrant, living a quiet life among books and history. Now, the commanding general - also known as her tough-as-talons mother - has ordered Violet to join the hundreds of candidates striving to become the elite of Navarre: dragon riders.\r\n\r\nBut when you\'re smaller than everyone else and your body is brittle, death is only a heartbeat away... because dragons don\'t bond to \'fragile\' humans. They incinerate them.\r\n\r\nWith fewer dragons willing to bond than cadets, most would kill Violet to better their own chances of success. The rest would kill her just for being her mother\'s daughter - like Xaden Riorson, the most powerful and ruthless wingleader in the Riders Quadrant. She\'ll need every edge her wits can give her just to see the next sunrise.\r\n\r\nYet, with every day that passes, the war outside grows more deadly, the kingdom\'s protective wards are failing, and the death toll continues to rise. Even worse, Violet begins to suspect leadership is hiding a terrible secret.\r\n\r\nAlliances will be forged. Lives will be lost. Traitors will become allies... or even lovers. But sleep with one eye open because once you enter, there are only two ways out: graduate or die.', 'fantasy', '2025-04-15'),
(37, 'Iron Flame', '', 'Rebecca Yarros', 2147483647, 1, 'Secrets, Sacrifice, Survival.\r\n\r\nAgainst all odds, Violet Sorrengail made it through her first year at Basgiath War College, but now, the real training begins. The stakes are higher than ever, and a determination to survive won\'t be enough this time.\r\n\r\nWhen a powerful new enemy threatens everything she cares about, including the man she loves, Violet must do whatever it takes to keep their secrets safe. One wrong move could have horrifying consequences - and as the web of lies spun by those in charge starts to unravel, nothing, not even dragon fire, may be enough to save them in the end.\r\n\r\nTHE DEADLY SECOND YEAR AT BASGIATH AWAITS', 'fantasy', '2025-04-15'),
(38, 'Orbital', '', 'Samantha Harvey', 2147483647, 2, 'A team of astronauts in the International Space Station collect meteorological data, conduct scientific experiments and test the limits of the human body. But mostly they observe. Together they watch their silent blue planet, circling it sixteen times, spinning past continents and cycling through seasons, taking in glaciers and deserts, the peaks of mountains and the swells of oceans. Endless shows of spectacular beauty witnessed in a single day.\r\n\r\nYet although separated from the world they cannot escape its constant pull. News reaches them of the death of a mother, and with it comes thoughts of returning home. They look on as a typhoon gathers over an island and people they love, in awe of its magnificence and fearful of its destruction.\r\n\r\nThe fragility of human life fills their conversations, their fears, their dreams. So far from earth, they have never felt more part - or protective - of it. They begin to ask, what is life without earth? What is earth without humanity?', 'sci-fi', '2025-04-15'),
(39, 'Atomic Habits', '', 'James Clear', 2147483647, 1, 'A revolutionary system to get 1 per cent better every day.\r\n\r\nPeople think when you want to change your life, you need to think big. But world-renowned habits expert James Clear has discovered another way. He knows that real change comes from the compound effect of hundreds of small decisions - doing two push-ups a day, waking up five minutes early, or holding a single short phone call. He calls them atomic habits.\r\n\r\nIn this ground-breaking book, Clears reveals exactly how these minuscule changes can grow into such life-altering outcomes. He uncovers a handful of simple life hacks (the forgotten art of Habit Stacking, the unexpected power of the Two Minute Rule, or the trick to entering the Goldilocks Zone), and delves into cutting-edge psychology and neuroscience to explain why they matter.\r\n\r\nAlong the way, he tells inspiring stories of Olympic gold medalists, leading CEOs, and distinguished scientists who have used the science of tiny habits to stay productive, motivated, and happy. These small changes will have a revolutionary effect on your career, your relationships, and your life.', 'self-help', '2025-04-15'),
(40, 'Feel-Good Productivity: How to Do More of What Matters to You', '', 'Ali Abdaal', 2147483647, 1, 'The secret to productivity isn\'t discipline. It\'s joy.\r\n\r\nWe think that productivity is all about hard work. That the road to success is lined with endless frustration and toil. But what if there\'s another way?\r\n\r\nDr Ali Abdaal - the world\'s most-followed productivity expert - has uncovered an easier, happier path to success. Drawing on decades of psychological research, he has found that the secret to productivity and success isn\'t grind - it\'s feeling good. If you can make your work feel good, then productivity takes care of itself.\r\n\r\nIn this revolutionary book, Ali reveals how the science of feel-good productivity can transform your life. He introduces the three hidden \'energisers\' that underpin enjoyable productivity, the three \'blockers\' we must overcome to beat procrastination, and the three \'sustainers\' that prevent burnout and help us achieve lasting fulfilment. He recounts the inspiring stories of founders, Olympians, and Nobel-winning scientists who embody the principles of Feel-Good Productivity. And he introduces the simple, actionable changes that you can use to achieve more and live better, starting today.\r\n\r\nArmed with Ali\'s insights, you won\'t just accomplish more. You\'ll feel happier and more fulfilled along the way.', 'self-help', '2025-04-15'),
(41, 'I Haven’t Been Entirely Honest with You', '', 'Miranda Hart', 2147483647, 1, 'Hello to you, I am with news. I have a new book.\r\n\r\nBasically, I have had an unexpectedly difficult decade – there have been surprising joys, but also challenging lows. I shall be honest about those, because what I discovered in the difficult times were my, what I call, treasures. Practical tools, values, ways, answers researched from some great scientists, neuroscientists, therapists, sociologists (all the ‘ists’) out there, that have led to a sense of freedom, joy, peace and physical recovery I never would have thought possible.\r\n\r\nIf you fancy having a read, then I hope my story might help your story. Rest assured there are funny stories along the way. Oh, and I couldn’t possibly say if there is a love story in it . . . (There is - shush) Exciting.', 'autobiography', '2025-04-15'),
(42, 'Surviving to Drive: A Year Inside Formula 1', '', 'Guenther Steiner', 2147483647, 1, '\'People talk about football managers being under pressure. Trust me, that\'s nothing. Pressure is watching one of your drivers hit a barrier at 190mph and exploding before your eyes...\'\r\n\r\nGuenther Steiner is one of motor racing\'s biggest and most celebrated characters, known to millions for his show-stealing appearances on Netflix\'s hugely popular fly on the wall series, Drive to Survive.\r\n\r\nIn Surviving to Drive, the Haas team principal takes readers inside his Formula 1 team for the entirety of the 2022 season, giving an unobstructed view of what really takes place behind the scenes. Through this unique lens, Guenther takes us on the thrilling rollercoaster of life at the heart of high stakes motor racing.\r\n\r\nPacked full of twists and turns, from hiring and firing drivers, balancing books, pre-season preparations, the design, launch and testing of a car - and of course, the race calendar itself - this is the first time that an F1 team has allowed an acting team principal to tell the full story of a whole season.\r\n\r\nUncompromising and searingly honest, told in Steiner\'s inimitable style, this is a fascinating and hugely entertaining account of the realities of running a Formula 1 team.', 'autobiography', '2025-04-15'),
(43, 'The Hunting Party', '', 'Lucy Foley', 2147483647, 3, 'Everyone\'s invited. Everyone\'s a suspect. \r\n\r\nBristling with tension, bitter rivalries, and toxic friendships, get ready for the most hotly-anticipated thriller of 2019.\r\n\r\nIn a remote hunting lodge, deep in the Scottish wilderness, old friends gather for New Year.\r\n\r\nThe beautiful one\r\nThe golden couple\r\nThe volatile one\r\nThe new parents\r\nThe quiet one\r\nThe city boy\r\nThe outsider\r\n\r\nThe victim.\r\n\r\nNot an accident - a murder among friends.', 'mystery', '2025-04-15'),
(44, 'In Too Deep: (Jack Reacher 29)', '', 'Lee Child', 2147483647, 3, '\'Reacher had no idea where he was. No idea how he had got there. But someone must have brought him. And shackled him. And whoever had done those things was going to rue the day. That was for damn sure.\'\r\n\r\nJack Reacher wakes up, alone, in the dark, handcuffed to a makeshift bed. His right arm has suffered some major damage. His few possessions are gone. He has no memory of getting there.\r\n\r\nThe last thing Reacher can recall is the car he hitched a ride in getting run off the road. The driver was killed.\r\n\r\nHis captors assume Reacher was the driver\'s accomplice and patch up his wounds as they plan to make him talk.\r\n\r\nA plan that will backfire spectacularly . . .', 'crime', '2025-04-15'),
(45, 'The Shining', '', 'Stephen King', 2147483647, 1, 'Danny is only five years old, but in the words of old Mr Hallorann he is a \'shiner\', aglow with psychic voltage. When his father becomes caretaker of the Overlook Hotel, Danny\'s visions grow out of control.\r\n\r\nAs winter closes in and blizzards cut them off, the hotel seems to develop a life of its own. It is meant to be empty. So who is the lady in Room 217 and who are the masked guests going up and down in the elevator? And why do the hedges shaped like animals seem so alive?\r\n\r\nSomewhere, somehow, there is an evil force in the hotel - and that, too, is beginning to shine...', 'horror', '2025-04-15'),
(46, 'IT', '', 'Stephen King', 2147483647, 1, 'The terror, which would not end for another twenty-eight years - if it ever did end – began, so far as I know or can tell, with a boat made from a sheet of newspaper floating down a gutter swollen with rain.\r\n\r\n\'They float...and when you\'re down here with me, you\'ll float, too.\'\r\n\r\nTo the children, the town was their whole world. To the adults, knowing better, Derry Maine was just their home town: familiar, well-ordered for the most part. A good place to live.\r\n\r\nIt is the children who see - and feel - what makes the small town of Derry so horribly different. In the storm drains, in the sewers, IT lurks, taking on the shape of every nightmare, each one\'s deepest dread. Sometimes IT reaches up, seizing, tearing, killing ...\r\n\r\nTime passes and the children grow up, move away and forget. Until they are called back, once more to confront IT as IT stirs and coils in the sullen depths of their memories, reaching up again to make their past nightmares a terrible present reality.', 'horror', '2025-04-15'),
(47, 'Funny Story', '', 'Emily Henry', 2147483647, 1, 'Daphne always loved the way Peter told their story.\r\n\r\nThat is until it became the prologue to his actual love story with his childhood bestie, Petra.\r\n\r\nWhich is how Daphne ends up rooming with her total opposite and the only person who could possibly understand her predicament: Petra\'s ex, Miles.\r\n\r\nAs expected, it’s not a match made in heaven – that is until one night, while tossing back tequilas, they form a plan.\r\n\r\nAnd if it involves posting deliberately misleading photos of their adventures together, well, who could blame them?\r\n\r\nBut it’s all just for show, of course, because there’s no way Daphne would actually start her new chapter by falling in love with her ex-fiancé’s new fiancée’s ex . . . right?', 'romance', '2025-04-15'),
(48, 'The Seven Husbands of Evelyn Hugo', '', 'Taylor Jenkins Reid', 2147483647, 1, 'From the author of Daisy Jones & The Six-an entrancing novel \"that speaks to the Marilyn Monroe and Elizabeth Taylor in us all\" (Kirkus Reviews), in which a legendary film actress reflects on her relentless rise to the top and the risks she took, the loves she lost, and the long-held secrets the public could never imagine.\r\n\r\nAging and reclusive Hollywood movie icon Evelyn Hugo is finally ready to tell the truth about her glamorous and scandalous life. But when she chooses unknown magazine reporter Monique Grant for the job, no one is more astounded than Monique herself. Why her? Why now?\r\n\r\nMonique is not exactly on top of the world. Her husband has left her, and her professional life is going nowhere. Regardless of why Evelyn has selected her to write her biography, Monique is determined to use this opportunity to jumpstart her career.\r\n\r\nSummoned to Evelyn\'s luxurious apartment, Monique listens in fascination as the actress tells her story. From making her way to Los Angeles in the 1950s to her decision to leave show business in the \'80s, and, of course, the seven husbands along the way, Evelyn unspools a tale of ruthless ambition, unexpected friendship, and a great forbidden love. Monique begins to feel a very real connection to the legendary star, but as Evelyn\'s story near its conclusion, it becomes clear that her life intersects with Monique\'s own in tragic and irreversible ways.\r\n\r\nA mesmerizing journey through the splendor of old Hollywood into the harsh realities of the present day as two women struggle with what it means-and what it costs-to face the truth.', 'romance', '2025-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `userName` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userType` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userID` int(4) NOT NULL,
  `dateAdded` date NOT NULL DEFAULT current_timestamp(),
  `maxBorrowedBooks` int(11) DEFAULT 5,
  `currentBorrowedBooks` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`userName`, `email`, `password`, `userType`, `userID`, `dateAdded`, `maxBorrowedBooks`, `currentBorrowedBooks`) VALUES
('Becca Wheildon', 'beccawheildon99@gmail.com', '$2y$10$nzDM3A0MvbUfJwz4lcEsNeXKT9HjIBGb6BoVQfnjLfusPBZ4CHeyu', 'Admin', 17, '2025-04-13', 5, 0),
('Alex Carter', 'Alex.Carter@hotmail.co.uk', '$2y$10$MLdLHl9KQyLvU7NoHX9U1e04lWH9BmIM2DMlGgOLs64egqAqtNSDu', 'User', 19, '2025-04-15', 5, 0),
('Emma Thompson', 'ethompson80@gmail.com', '$2y$10$cyv3zT4epI1VHojgXEHHhO1SO/H4OxpWz.Ffxp2hr5B2es1c7dGGa', 'User', 20, '2025-04-15', 5, 0),
('Noah Bennett', 'noahbennett@gmail.com', '$2y$10$Wp9xGm/CgqK8WWuuiyJJfel/U2XSEK9YEHsSO/hDJTnMK43xt8DHK', 'User', 21, '2025-04-15', 5, 0),
('Sophia Turner', 'SophiaT@hotmail.co.uk', '$2y$10$Pd171YhdOu1mQdIc97G0ZemlpkNju4mGMx/UOTF.hH1TLIGLHLOIm', 'User', 23, '2025-04-15', 5, 0),
('Liam Roberts', 'RobLiam@outlook.co.uk', '$2y$10$zMj9gZY3KsYscYJA4FRF2uO12WIwmgkLCDqhyuGGCJlgiiasNbv66', 'User', 24, '2025-04-15', 5, 0),
('Olivia Wilson', 'o.wilson@rgu.ac.uk', '$2y$10$EqxdAjHNhkRIURrlx6yes.MfukcTUDbDkMShjJvlLZCRdt5MfPxey', 'User', 25, '2025-04-15', 5, 0),
('Ethan Kelly', 'Ethan.Kelly@gu.ac.uk', '$2y$10$0T6AcCE0Gk/52sdxn4ueJOQ37crr0pw/GdguJTc/xE4UwBtx2Q6nm', 'User', 26, '2025-04-15', 5, 0),
('Mia Sullivan', 'MiaSul@gmail.com', '$2y$10$O8lmCJz8iI9cWibg.upVHudRl1L1rl.zjr2KWZMakAXtp09wY0DaW', 'User', 27, '2025-04-15', 5, 0),
('Jackson Hayes', 'jack.hayes@outlook.co.uk', '$2y$10$j2qp3JbRfCmIL23aYQQU...uyeztHZ50yzaz3KLV38MNeGWpZIz9W', 'User', 28, '2025-04-15', 5, 0),
('Rebecca Wheildon', 'rebeccawheildon16@gmail.com', '$2y$10$VdWQlkKj/hSD9xPNmrq9Q.5pblWy4L51cOl4/4.Bvw8h2ybYbRwcy', 'User', 31, '2025-04-16', 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookcovers`
--
ALTER TABLE `bookcovers`
  ADD PRIMARY KEY (`imgID`),
  ADD KEY `fk_bookcovers_bookid` (`bookID`);

--
-- Indexes for table `bookreservation`
--
ALTER TABLE `bookreservation`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `bookID` (`bookID`),
  ADD KEY `reservationEmail` (`reservationEmail`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`),
  ADD UNIQUE KEY `bookID` (`bookID`),
  ADD UNIQUE KEY `bookID_2` (`bookID`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookcovers`
--
ALTER TABLE `bookcovers`
  MODIFY `imgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bookreservation`
--
ALTER TABLE `bookreservation`
  MODIFY `reservationID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookreservation`
--
ALTER TABLE `bookreservation`
  ADD CONSTRAINT `bookreservation_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`),
  ADD CONSTRAINT `bookreservation_ibfk_2` FOREIGN KEY (`reservationEmail`) REFERENCES `userdetails` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
