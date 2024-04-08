CREATE TABLE Films (
   IdFilm INT AUTO_INCREMENT PRIMARY KEY,
   poster VARCHAR(255),
   NomFilm VARCHAR(255),
   Année INT,
   Pays VARCHAR(100),
   Genre VARCHAR(100)
);

CREATE TABLE Series (
   IdSerie INT AUTO_INCREMENT PRIMARY KEY,
   poster VARCHAR(255),
   NomSerie VARCHAR(255),
   Année INT,
   Pays VARCHAR(100),
   Genre VARCHAR(100)
);

CREATE TABLE Likes (
   IdLike INT AUTO_INCREMENT PRIMARY KEY,
   Username VARCHAR(50),
   IdFilm INT,
   LikeStatus ENUM('like', 'dislike'), 
   FOREIGN KEY (Username) REFERENCES Utilisateurs(Username),
   FOREIGN KEY (IdFilm) REFERENCES Films(IdFilm),
   UNIQUE KEY unique_like (Username, IdFilm)
);

CREATE TABLE Roles (
   RoleId INT PRIMARY KEY,
   NomRole VARCHAR(50)  
);

CREATE TABLE Utilisateurs (
   Username VARCHAR(50) PRIMARY KEY,
   HashedPassword VARCHAR(255),
   Salt VARCHAR(64),
   AdresseMail VARCHAR(255),
   DateInscription DATE,
   RoleId INT NOT NULL,
   PhotoProfil VARCHAR(255) default 'Images/X.png',
   FOREIGN KEY (RoleId) REFERENCES Roles(RoleId)
);

CREATE TABLE InfoUtilisateurs (
   DateNaissance DATE,
   Bio VARCHAR(255),
   Pays VARCHAR(100),
   NomUtilisateur VARCHAR(100),
   Phone VARCHAR(20),
   Username VARCHAR(50),
   FOREIGN KEY (Username) REFERENCES Utilisateurs(Username)
);


INSERT INTO Films (IdFilm, poster, NomFilm, Année, Pays, Genre)
VALUES
   (1, 'oldboy.jpg', 'Old Boy', 2003, 'Corée', 'Action'),
   (2, 'Affranch.webp', 'Les Affranchis', 1990, 'USA', 'Gangster'),
   (3, 'theThingg.webp', 'The Thing', 1982, 'USA', 'Horreur'),
   (4, 'spider.jpg', 'Spider-Man', 2002, 'USA', 'Super Hero'),
   (5, 'darkKnight.webp', 'Batman', 2008, 'USA', 'Super Hero'),
   (6, 'Midsommarr.webp', 'Midsommar', 2019, 'USA', 'Horreur'),
   (7, 'alien1.webp', 'Alien', 1979, 'USA', 'Science-Fiction'),
   (8, 'ingloriuss.jpg', 'Inglourious Basterds', 2009, 'USA', 'Guerre'),
   (9, 'theHost.jpg', 'The Host', 2006, 'Corée', 'Science-Fiction'),
   (10, 'alger.jpg', 'La Bataille d Alger', 1966, 'Algérie', 'Guerre'),
   (11, 'nope.webp', 'NOPE', 2022, 'USA', 'Science-Fiction'),
   (12, 'zodiac.jpg', 'Zodiac', 2007, 'USA', 'Thriller'),
   (13, 'whiplash.jpg', 'Whiplash', 2014, 'USA', 'Musical'),
   (14, 'SinCity.jpg', 'SinCity', 1995, 'USA', 'Super Hero'),
   (15, 'cityof.jpg', 'La Cité de Dieu', 2002, 'Brésil', 'Gangster'),
   (16, 'therewillbeblood.jpg', 'There Will Be Blood', 2007, 'USA', 'Western'),
   (17, 'theRevenant.jpg', 'The Revenant', 2015, 'USA', 'Western'),
   (18, 'the_creator.webp', 'The Creator', 1999, 'USA', 'Science-Fiction'),
   (19, 'StarWars.webp', 'Star Wars', 1977, 'USA', 'Science-Fiction'),
   (20, 'TaxiDriverr.webp', 'Taxi Driver', 1976, 'USA', 'Drame'),
   (21, 'tenett.jpg', 'Tenet', 2020, 'USA', 'Science-Fiction'),
   (22, 'snatchh.webp', 'Snatch', 2000, 'USA', 'Comédie'),
   (23, 'Anatomie_Chute.jpg', 'Anatomie d une chute', 2023, 'France', 'Drame'),
   (24, 'arrivall.jpg', 'Arrival', 2016, 'USA', 'Science-Fiction'),
   (25, 'annette.jpg', 'Annette', 2021, 'USA', 'Musical'),
   (26, 'alien1.webp', 'Alien', 1979, 'USA', 'Science-Fiction'),
   (27, 'avatarr.jpg', 'Avatar', 2009, 'USA', 'Science-Fiction'),
   (28, 'avatar2.jpg', 'Avatar 2', 2022, 'USA', 'Science-Fiction'),
   (29, 'banshees.jpg', 'Les Banshees d Inisherin', 2022, 'USA', 'Drame'),
   (30, 'Birdman.jpg', 'Birdman', 2014, 'USA', 'Comédie'),
   (31, 'BladeRunnerr.webp', 'Blade Runner', 1982, 'USA', 'Science-Fiction'),
   (32, 'blow.jpg', 'Blow', 2001, 'USA', 'Drame'),
   (33, 'Collateral.jpg', 'Collateral', 2004, 'USA', 'Action'),
   (34, 'come_and_see.jpg', 'Come And See', 1985, 'USA', 'Guerre'),
   (35, 'jaws.webp', 'Jaws', 1975, 'USA', 'Horreur'),
   (36, 'deathProof.jpg', 'Death Proof', 2007, 'USA', 'Action'),
   (37, 'dune.jpg', 'Dune', 2021, 'USA', 'Science-Fiction'),
   (38, 'Dune2.jpg', 'Dune 2', 2024, 'USA', 'Science-Fiction'),
   (39, 'Dunkirk.jpg', 'Dunkerque', 2017, 'USA', 'Guerre'),
   (40, 'fable.jpg', 'The Fablemans', 2022, 'USA', 'Drame'),
   (41, 'facebook.jpg', 'The Social Network', 2010, 'USA', 'Biographie'),
   (42, 'forrest.jpg', 'Forrest Gump', 1994, 'USA', 'Comédie'),
   (43, 'getOut.jpg', 'Get Out', 2017, 'USA', 'Horreur'),
   (44, 'gladiator.jpg', 'Gladiator', 2000, 'USA', 'Guerre'),
   (45, 'Gremlinss.webp', 'Gremlins', 1984, 'USA', 'Science-Fiction'),
   (46, 'Hana-bi.jpg', 'Hana-Bi', 1997, 'USA', 'Drame'),
   (47, 'Hereditary.webp', 'Hereditary', 2018, 'USA', 'Horreur'),
   (48, 'Lesevadéss.webp', 'Les Évadés', 1994, 'USA', 'Drame'),
   (49, 'Inception.webp', 'Inception', 2010, 'USA', 'Action'),
   (50, 'lalalala.webp', 'Les Infiltrés', 2006, 'USA', 'Action'),
   (51, 'Extra.jpg', 'E.T', 1982, 'USA', 'Science-Fiction'),
   (52, 'Interstellarr.webp', 'Interstellar', 2014, 'USA', 'Science-Fiction'),
   (53, 'jokerr.webp', 'Joker', 2019, 'USA', 'Drame'),
   (54, 'jurassicc.jpg', 'Jurassic Park', 1993, 'USA', 'Science-Fiction'),
   (55, '300.jpg', '300', 2007, 'USA', 'Guerre'),
   (56, 'KillBill.jpg', 'Kill Bill ', 2003, 'USA', 'Action'),
   (57, 'LaFureurDragon.jpg', 'La Fureur Dragon', 1972, 'USA', 'Action'),
   (58, 'killeroftheflowermoonn.jpg', 'Killer Of The Flower Moon', 2023, 'USA', 'Drame'),
   (59, 'Kung_Fu_Panda_4.jpg', 'Kung Fu Panda 4', 2024, 'USA', 'Animation'),
   (60, 'la-la-land.webp', 'La La Land', 2016, 'USA', 'Musical'),
   (61, 'lebonlabruteetletruandd.webp', 'Le Bon, la Brute et le Truand', 1966, 'USA', 'Western'),
   (62, 'leMenuu.jpg', 'Le Menu', 2022, 'USA', 'Thriller'),
   (63, 'les8.jpg', 'Les 8 Salopards', 2015, 'USA', 'Western'),
   (64, 'LittleMissSunshine.jpg', 'Little Miss Sunshine', 2006, 'USA', 'Comédie'),
   (65, 'Mademoiselle.jpg', 'Mademoiselle', 2016, 'Corée', 'Drame'),
   (66, 'madMax.jpg', 'Mad Max: Fury Road', 2015, 'USA', 'Action'),
   (67, 'Magnolia.jpg', 'Magnolia', 1999, 'USA', 'Drame'),
   (68, 'matrixx.webp', 'Matrix', 1999, 'USA', 'Science-Fiction'),
   (69, 'memento.jpg', 'Memento', 2000, 'USA', 'Thriller'),
   (70, 'memoriesOfMurderr.webp', 'Memories of Murder', 2003, 'Corée', 'Thriller'),
   (71, 'coco.jpg', 'Coco', 2017, 'USA', 'Animation'),
   (72, 'Minority_Report.jpg', 'Minority Report', 2002, 'USA', 'Science-Fiction'),
   (73, 'mozart.jpg', 'Amadeus', 1984, 'USA', 'Biographie'),
   (74, 'MrJack.jpg', 'L Étrange Noël de Mr. Jack', 1993, 'USA', 'Animation'),
   (75, 'mysticRiver.jpg', 'Mystic River', 2003, 'USA', 'Drame'),
   (76, 'nope.webp', 'NOPE', 2022, 'USA', 'Horreur'),
   (77, 'Once.jpg', 'Once Upon a Time in Hollywood', 2019, 'USA', 'Comédie'),
   (78, 'oppenheimer.jpg', 'Oppenheimer', 2023, 'USA', 'Biographie'),
   (79, 'Parasite.jpg', 'Parasite', 2019, 'Corée', 'Drame'),
   (80, 'parrain.webp', 'Le Parrain', 1972, 'USA', 'Gangster'),
   (81, 'pearl.webp', 'Pearl', 2001, 'USA', 'Biographie'),
   (82, 'prisonerss.jpg', 'Prisoners', 2013, 'USA', 'Thriller'),
   (83, 'Psycho.webp', 'Psycho', 1960, 'USA', 'Horreur'),
   (84, 'pulpFiction.webp', 'Pulp Fiction', 1994, 'USA', 'Crime'),
   (85, 'reservoirDogs.webp', 'Reservoir Dogs', 1992, 'USA', 'Crime'),
   (86, 'retourdanss.webp', 'Retour vers le Futur', 1985, 'USA', 'Science-Fiction'),
   (87, 'sevenn.jpg', 'Seven', 1995, 'USA', 'Thriller'),
   (88, 'Sommet.jpg', 'Le Sommet', 2021, 'Français', 'Drame'),
   (89, '7Samourais.jpg', 'Les 7 Samourais', 1954, 'Japon', 'Guerre'),
   (90, 'YI.jpg', 'YI YI', 2000, 'Chine', 'Drame'),
   (91, 'BenHur.jpg', 'Ben Hur', 1959, 'USA', 'Guerre'),
   (92, 'Lobster.jpg', 'The Lobster', 2015, 'USA', 'Drame'),
   (93, 'POOR.jpg', 'Poor Thing', 2024, 'USA', 'Fantastique'),
   (94, 'GoneGirl.jpg', 'Gone Girl', 2014, 'USA', 'Thriller'),
   (95, 'DeadZone.jpg', 'Dead Zone', 1983, 'USA', 'Science-Fiction'),
   (96, 'PacificRim.jpg', 'Pacific Rim', 2013, 'USA', 'Science-Fiction'),
   (97, 'Ran.jpg', 'Ran', 1985, 'Japon', 'Science-Fiction'),
   (98, 'Begins.webp', 'Batman Begins', 2013, 'USA', 'Super Heros'),
   (99, 'Fargo.jpg', 'Fargo', 1996, 'USA', 'Drame'),
   (100, 'shining.jpg', 'Shining', 1980, 'USA', 'Horreur'),
   (101, 'Jobs.jpg', 'Steve Jobs', 2015, 'USA', 'Biographie'),
   (102, 'MrFox.jpg', 'Fantastic Mr. Fox', 2009, 'USA', 'Animation'),
   (103, 'adAstra.jpg', 'Ad Astra', 2019, 'USA', 'Science-Fiction'),
   (104, 'BulletTrain.jpg', 'Bullet Train', 2022, 'USA', 'Action'),
   (105, 'yannick.jpg', 'Les Choristes', 2004, 'France', 'Drame'),
   (106, 'Jackie.jpg', 'Jackie', 2016, 'USA', 'Biographie'),
   (107, 'django.jpg', 'Django Unchained', 2012, 'USA', 'Western'),
   (108, 'Vertigo.jpg', 'Vertigo', 1958, 'USA', 'Mystère'),
   (109, 'JeuDeLaMort.jpg', 'Enter the Dragon', 1973, 'Hong Kong', 'Action'),
   (110, '12Hommes.png', '12 Angry Men', 1957, 'USA', 'Drame'),
   (111, 'LordOfWar.jpg', 'Lord of War', 2005, 'USA', 'Drame'),
   (112, 'LightHouse.jpg', 'The Lighthouse', 2019, 'USA', 'Horreur'),
   (113, 'Witch.jpg', 'The Witch', 2015, 'USA', 'Horreur'),
   (114, 'Predator.jpg', 'Predator', 1987, 'USA', 'Action'),
   (115, 'Akira.jpg', 'Akira', 1988, 'Japan', 'Animation'),
   (116, 'Asteroide.jpg', 'Asteroide City', 2023, 'USA', 'Comédie'),
   (117, 'terminator.jpg', 'Terminator', 2017, 'USA', 'Action'),
   (118, '2001.png', '2001 l odyssée de l espace', 1968, 'USA', 'Science-Fiction'),
   (119, 'Romulus.jpg', 'Alien Romulus', 2024, 'USA', 'Horreur'),
   (120, 'JSA.jpg', 'JSA', 2000, 'USA', 'Drame'),
   (121, 'Batman.jpg', 'The Batman', 2022, 'USA', 'Super Heros'),
   (122, 'Ring.jpg', 'Le seigneur des anneaux', 2002, 'USA', 'Aventure'),
   (123, 'American.jpg', 'American Psycho', 2017, 'USA', 'Horreur'),
   (124, 'Cars.jpg', 'Cars', 2017, 'USA', 'Animation'),
   (125, 'Godzilla.jpg', 'Godzilla', 2014, 'USA', 'Science-Fiction'),
   (126, 'Singes.jpg', 'La planete des Singes', 1968, 'USA', 'Science-Fiction');
   

INSERT INTO Series (IdSerie, poster, NomSerie, Année, Pays, Genre)
VALUES 
      (1,'TheBoys.jpg','The Boys',2019,'USA','Super Heros'),
      (2,'BreakingBadd.jpg','Breaking Bad',2019,'USA','Drame'),
      (3,'GOT.jpg','Game Of Throne',2019,'USA','Fantastique'),
      (4,'Sopranos.jpg','The Sopranos',2019,'USA','Drame'),
      (5,'Succession.jpg','Succession',2019,'USA','Drame'),
      (6,'Chernobyl.jpg','Chernobyl',2019,'USA','Drame');




INSERT INTO Roles (RoleId , NomRole)
VALUES
      (1 , "Admin"),
      (2 , "Utilisateur");



DROP TABLE IF EXISTS Films;
DROP TABLE IF EXISTS Series;
DROP TABLE IF EXISTS Likes;
DROP TABLE IF EXISTS Roles;
DROP TABLE IF EXISTS Utilisateurs;
DROP TABLE IF EXISTS InfoUtilisateurs;




-- https://app.diagrams.net/