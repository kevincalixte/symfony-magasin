DROP TABLE IF EXISTS commande_produit;
DROP TABLE IF EXISTS commande;
DROP TABLE IF EXISTS produit;
DROP TABLE IF EXISTS client;
-- Création des tables
CREATE TABLE client (
	id INT PRIMARY KEY,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	roles TEXT NOT NULL
);

CREATE TABLE produit (
	id INT PRIMARY KEY,
	nom VARCHAR(100) NOT NULL,
	prix_unitaire DECIMAL(10,2) NOT NULL,
	categorie VARCHAR(100) NOT NULL
);

CREATE TABLE commande (
	id INT PRIMARY KEY,
	client_id INT NOT NULL,
	date_commande DATE NOT NULL,
	FOREIGN KEY (client_id) REFERENCES client(id)
);

CREATE TABLE commande_produit (
	id INT PRIMARY KEY,
	commande_id INT NOT NULL,
	produit_id INT NOT NULL,
	quantite INT NOT NULL,
	FOREIGN KEY (commande_id) REFERENCES commande(id),
	FOREIGN KEY (produit_id) REFERENCES produit(id)
);
INSERT INTO client (id, email, password, roles) VALUES
(1, 'admin@example.com', '$2y$13$gy7zZDkIaO7TG07hq.bBxuHZxgxLbndyodS8QZ1mp1tY0uyucqyk6', '["ROLE_ADMIN"]');

-- Produits
INSERT INTO produit (id, nom, prix_unitaire, categorie) VALUES
(1, 'Stylo', 1.50, 'Papeterie'),
(2, 'Cahier', 2.00, 'Papeterie'),
(3, 'Gomme', 0.80, 'Papeterie'),
(4, 'Calculatrice', 15.00, 'Electronique'),
(5, 'Sac à dos', 25.00, 'Bagagerie'),
(6, 'Crayon', 1.00, 'Papeterie'),
(7, 'Règle', 1.20, 'Papeterie'),
(8, 'Agenda', 5.00, 'Papeterie'),
(9, 'Trousse', 8.00, 'Bagagerie'),
(10, 'Tablette', 120.00, 'Electronique');

-- 5 produits jamais commandés
INSERT INTO produit (id, nom, prix_unitaire, categorie) VALUES
(11, 'Pochette', 3.50, 'Bagagerie'),
(12, 'Feutre', 2.20, 'Papeterie'),
(13, 'Classeur', 4.00, 'Papeterie'),
(14, 'Surligneur', 1.80, 'Papeterie'),
(15, 'Chargeur USB', 9.90, 'Electronique');


-- Commandes
INSERT INTO commande (id, client_id, date_commande) VALUES
(1, 1, '2026-02-10'),
(2, 2, '2026-02-11'),
(3, 1, '2026-02-12'),
(4, 2, '2026-01-15'),
(5, 3, '2026-02-13'),
(6, 1, '2025-12-20'),
(7, 3, '2026-02-14');

INSERT INTO commande_produit (id, commande_id, produit_id, quantite) VALUES
(1, 1, 1, 10), -- Client 1 achète 10 stylos
(2, 1, 2, 5),  -- Client 1 achète 5 cahiers
(3, 2, 2, 8),  -- Client 2 achète 8 cahiers
(4, 2, 3, 3),  -- Client 2 achète 3 gommes
(5, 3, 1, 2),  -- Client 1 achète 2 stylos
(6, 3, 3, 4),  -- Client 1 achète 4 gommes
(7, 4, 4, 1),  -- Client 2 achète 1 calculatrice
(8, 4, 6, 10), -- Client 2 achète 10 crayons
(9, 5, 5, 2),  -- Client 3 achète 2 sacs à dos
(10, 5, 7, 5), -- Client 3 achète 5 règles
(11, 6, 8, 3), -- Client 1 achète 3 agendas
(12, 7, 9, 1), -- Client 3 achète 1 trousse
(13, 7, 10, 1); -- Client 3 achète 1 tablette