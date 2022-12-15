-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2022 at 12:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jhemming1_dmit2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `boardgame_catalog`
--

CREATE TABLE `boardgame_catalog` (
  `gametitle` varchar(225) DEFAULT NULL,
  `gamedesigner` varchar(225) DEFAULT NULL,
  `publisher` varchar(225) DEFAULT NULL,
  `releaseyear` varchar(4) DEFAULT NULL,
  `mechanics` varchar(225) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `videofileurl` varchar(225) DEFAULT NULL,
  `gameid` int(11) NOT NULL,
  `playermin` varchar(3) NOT NULL DEFAULT '1',
  `playermax` varchar(3) DEFAULT NULL,
  `uploadon` date DEFAULT NULL,
  `popularity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `boardgame_catalog`
--

INSERT INTO `boardgame_catalog` (`gametitle`, `gamedesigner`, `publisher`, `releaseyear`, `mechanics`, `description`, `videofileurl`, `gameid`, `playermin`, `playermax`, `uploadon`, `popularity`) VALUES
('Mysterium ', 'Mysterium ', 'Libellud', '2015', 'coop,deduction', 'In the 1920s, Mr. MacDowell, a gifted astrologer, immediately detected a supernatural being upon entering his new house in Scotland. He gathered eminent mediums of his time for an extraordinary sÃ©ance, and they have seven hours to make contact with the ghost and investigate any clues that it can provide to unlock an old mystery.', 'https://www.youtube.com/watch?v=mhCv0CZW2UM', 89, '2', '7', '2022-12-14', 0),
('Magic Maze', 'Magic Maze', 'Sit Down!', '2017', 'coop,real-time', 'After being stripped of all their possessions, a mage, a warrior, an elf, and a dwarf are forced to go rob the local Magic Maze shopping mall for all the equipment necessary for their next adventure.', '', 90, '1', '8', '2022-12-14', 0),
('Clank!', 'Clank!', 'Renegade Game Studios', '2016', 'deck-building,push-your-luck', 'Burgle your way to adventure in the deck-building board game Clank! Sneak into an angry dragon\'s mountain lair to steal precious artifacts. Delve deeper to find more valuable loot. Acquire cards for your deck and watch your thievish abilities grow.', '', 91, '2', '4', '2022-12-14', 0),
('Architects of the West Kingdom ', 'Architects of the West Kingdom ', 'Renegade Game Studios', '2018', 'drafting,worker-placement', 'Architects of the West Kingdom is set at the end of the Carolingian Empire, circa 850 AD. As royal architects, players compete to impress their King and maintain their noble status by constructing various landmarks throughout his newly appointed domain', '', 92, '1', '5', '2022-12-14', 0),
('Dominion', 'Dominion', 'Rio Grande Games', '2008', 'deck-building', 'You are a monarch, like your parents before you, a ruler of a small pleasant kingdom of rivers and evergreens. Unlike your parents, however, you have hopes and dreams! You want a bigger and more pleasant kingdom, with more rivers and a wider variety of trees. You want a Dominion!', 'https://www.youtube.com/watch?v=5jNGpgdMums', 93, '2', '4', '2022-12-14', 0),
('Airlines Europe', 'Alan R. Moon', 'Rio Grande Games', '2011', 'investment,drafting,set-collection', 'At its heart, Airlines Europe is a stock game, with players earning points for the stock they hold in particular airline companies when one of the randomly determined scorings takes place.', '', 100, '2', '5', '2022-12-14', 0),
('Catan', 'Klaus Teuber', 'KOSMOS', '1995', 'luck,resource-management,income', 'In CATAN (formerly The Settlers of Catan), players try to be the dominant force on the island of Catan by building settlements, cities, and roads.', '', 101, '3', '4', '2022-12-14', 9),
('Ticket to Ride', 'Alan R. Moon', 'Days of Wonder', '2004', 'set-collection,contracts', 'Players collect cards of various types of train cars they then use to claim railway routes in North America. The longer the routes, the more points they earn. Additional points come to those who fulfill Destination Tickets â€“ goal cards that connect distant cities; and to the player who builds the longest continuous route.', '', 102, '2', '5', '2022-12-14', 12),
('Gloomhaven', 'Isaac Childres', 'Cephalofair Games', '2017', 'legacy,hand-management,role-playing', 'Players must work together out of necessity to clear out menacing dungeons and forgotten ruins. In the process, they will enhance their abilities with experience and loot, discover new locations to explore and plunder, and expand an ever-branching story fueled by the decisions they make.', '', 103, '1', '4', '2022-12-14', 11),
('Forge War', 'Isaac Childres', 'Cephalofair Games', '2015', 'role-playing', 'In Forge War, players will take on the role of blacksmiths in a kingdom rife with marauding harpies, cursed dungeons and fire-breathing dragons. They are charged with gathering ore from the mines, purchasing weapon designs from the market and then using these resources to forge weapons for adventurers who will go on quests to fight back the ever-deepening darkness', 'https://www.youtube.com/watch?v=CfHr8XlWWwc', 104, '1', '4', '2022-12-14', 0),
('Terraforming Mars: Ares Expedition ', 'Sydney Engelstein', 'Stronghold Games', '2021', 'income,hand-management', 'Is an engine-building game in which players control interplanetary corporations with the goal of making Mars habitable (and profitable). You will do this by investing mega credits (MC) into project cards that will directly or indirectly contribute to the terraforming process. In order to win, you will want to accumulate a high terraform rating (TR) and as many victory points (VP) as you can. ', '', 105, '1', '4', '2022-12-14', 0),
('Brass: Birmingham ', 'Martin Wallace', 'Roxely', '2018', 'income,hand-management', 'Brass: Birmingham is an economic strategy game sequel to Martin Wallace\' 2007 masterpiece, Brass. Brass: Birmingham tells the story of competing entrepreneurs in Birmingham during the industrial revolution, between the years of 1770-1870.', '', 106, '2', '4', '2022-12-14', 1),
('Tapestry ', 'Jamey Stegmaier', 'Stonemaier Games', '2019', 'resource-management,contracts', 'Create the civilization with the most storied history, starting at the beginning of humankind and reaching into the future. The paths you choose will vary greatly from real-world events or people â€” your civilization is unique!', '', 107, '1', '5', '2022-12-14', 1),
('Scythe', 'Jamey Stegmaier', 'Stonemaier Games', '2016', 'contracts,combat,resource-management', 'It is a time of unrest in 1920s Europa. The ashes from the first great war still darken the snow. The capitalistic city-state known simply as â€œThe Factoryâ€, which fueled the war with heavily armored mechs, has closed its doors, drawing the attention of several nearby countries.', '', 108, '1', '5', '2022-12-14', 1),
('Secret Hitler', 'Mike Boxleiter', 'Goat Wolf & Cabbage ', '2016', 'hidden-roles,voting,social-deduction', 'Secret Hitler is a dramatic game of political intrigue and betrayal set in 1930s Germany. Each player is randomly and secretly assigned to be a liberal or a fascist, and one player is Secret Hitler. The fascists coordinate to sow distrust and install their cold-blooded leader; the liberals must find and stop the Secret Hitler before it\\\'s too late. The liberal team always has a majority.', '', 109, '5', '10', '2022-12-14', 0),
('Shadow Hunters', 'Yasutaka Ikeda', 'Game Republic, Inc.', '2005', 'social-deduction,hidden-roles', 'Shadow Hunters is a survival board game set in a devil-filled forest in which three groups of charactersâ€”the Shadows, creatures of the night; the Hunters, humans who try to destroy supernatural creatures; and the Neutrals, civilians caught in the middle of this ancient battleâ€”struggle against each other to survive.', 'https://www.youtube.com/watch?v=zce6z8K2pyEhttps://www.youtube.com/watch?v=zce6z8K2pyE', 110, '4', '8', '2022-12-14', 0),
('GKR: Heavy Hitter', 'Matt Hyra', 'Cryptozoic Entertainment', '2018', 'combat,area-control,deck-building', 'GKR: HEAVY HITTERS is an advertising-driven, televised combat sport where mega corporations fight for lucrative salvage rights and advertising dominance in Earthâ€™s abandoned cities. But more importantly, they need you! Your skills as a pilot and tactician are needed to win, gaining your Faction more fans, and more importantly, loyal consumers.', '', 111, '1', '4', '2022-12-14', 0),
('Adrenaline', 'Filip Neduk', 'Czech Games Edition', '2016', 'combat,resource-management,drafting', 'In the future, war has left the world in complete destruction and split the people into factions. The factions have decided to stop the endless war and settle their dispute in the arena. A new virtual bloodsport was created. The Adrenaline tournament. Every faction has a champion, every champion has a chance to fight and the chance to win. Will you take the chance of becoming the next champion of the Adrenaline tournament?', 'https://www.youtube.com/watch?v=2TGT9k9YewM', 112, '3', '5', '2022-12-14', 1),
('Last Will', 'VladimÃ­r SuchÃ½', 'Czech Games Edition', '2016', 'worker-placement,hand-management', 'In his last will, your rich uncle stated that all of his millions will go to the nephew who can enjoy money the most. How to find out which nephew should be rich? You will each be given a large amount of money and whoever can spend it first will be the rightful heir. ', '', 113, '2', '5', '2022-12-14', 1),
('The Quacks of Quedlinburg ', 'Wolfgang Warsch', 'Schmidt Spiele', '2018', 'push-your-luck,deck-building', 'In The Quacks of Quedlinburg, players are charlatans â€” or quack doctors â€” each making their own secret brew by adding ingredients one at a time. Take care with what you add, though, for a pinch too much of this or that will spoil the whole mixture!', '', 114, '2', '4', '2022-12-14', 0),
('Everdell', 'James A. Wilson', 'Starling Games (II)', '2018', 'contracts,resource-management,income', 'Within the charming valley of Everdell, beneath the boughs of towering trees, among meandering streams and mossy hollows, a civilization of forest critters is thriving and expanding. From Everfrost to Bellsong, many a year have come and gone, but the time has come for new territories to be settled and new cities established.', 'https://www.youtube.com/watch?v=1b9zQz7COxs', 115, '1', '4', '2022-12-14', 0),
('The Oilman Game ', '', 'Cardium Games Ltd.', '1994', 'auction,income', 'From the box: A game that captures the true to life excitement and drama, success, and failures of the international oil magnate.', '', 116, '2', '8', '2022-12-14', 0),
('Pandemic ', 'Matt Leacock', 'Z-Man Games', '2008', 'coop,hand-management,set-collection', 'In Pandemic, several virulent diseases have broken out simultaneously all over the world! The players are disease-fighting specialists whose mission is to treat disease hotspots while researching cures for each of four plagues before they get out of hand.', '', 117, '2', '4', '2022-12-14', 0),
('Hanabi', 'Antoine Bauza', 'Cocktail Games', '2010', 'coop,memory,hand-management', 'Hanabiâ€”named for the Japanese word for \"fireworks\"â€”is a cooperative game in which players try to create the perfect fireworks show by placing the cards on the table in the right order. (In Japanese, hanabi is written as èŠ±ç«; these are the ideograms flower and fire, respectively.)', '', 118, '2', '5', '2022-12-14', 0),
('Shadows over Camelot', 'Bruno Cathala', 'Days of Wonder', '2005', 'coop,deduction', 'Each player represents a knight of the Round Table and they must collaborate to overcome a number of quests, ranging from defeating the Black Knight to the search for the Holy Grail. Completed quests place white swords on the Round Table; failed quests add black swords and/or siege engines around Camelot.', '', 119, '3', '7', '2022-12-14', 0),
('Nation', 'Rustan HÃ¥kansson', 'Lautapelit.fi', '2013', 'drafting,resource-management,income', 'From the humble beginnings of civilization through the historical ages of progress, mankind has lived, fought, and built together in nations. Great nations protect and provide for their own, while fighting and competing against both other nations and nature itself. Nations must provide food and stability as the population increases. ', '', 120, '1', '5', '2022-12-14', 0),
('Twilight Imperium: Fourth Edition ', 'Dane Beltrami', 'Fantasy Flight Games', '2017', 'combat,area-control,income', 'Twilight Imperium (Fourth Edition) is a game of galactic conquest in which three to six players take on the role of one of seventeen factions vying for galactic domination through military might, political maneuvering, and economic bargaining. ', '', 121, '3', '6', '2022-12-14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boardgame_catalog`
--
ALTER TABLE `boardgame_catalog`
  ADD PRIMARY KEY (`gameid`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boardgame_catalog`
--
ALTER TABLE `boardgame_catalog`
  MODIFY `gameid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
