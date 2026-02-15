Voici l’exercice reformulé simplement et bien détaillé, avec toutes les étapes :

---

## Exercice : Calculer le chiffre d’affaires total par produit dans un magasin

### 1. Objectif
Afficher le chiffre d’affaires (CA) total réalisé pour chaque produit, en utilisant une base de données qui gère les clients, les commandes et les produits.

---

### 2. Structure des tables

- **client**  
  id, nom, email

- **produit**  
  id, nom, prix_unitaire

- **commande**  
  id, client_id, date_commande

- **commande_produit**  
  id, commande_id, produit_id, quantite

---

### 3. Étapes à réaliser

#### Étape 1 : Créer les entités

- **Client** : id, nom, email
- **Produit** : id, nom, prix_unitaire
- **Commande** : id, client (ManyToOne vers Client), date_commande
- **CommandeProduit** : id, commande (ManyToOne vers Commande), produit (ManyToOne vers Produit), quantite

#### Étape 2 : Créer le repository CommandeProduitRepository

- Ajouter une méthode personnalisée :  
  chiffreAffairesParProduit()  
  Cette méthode doit retourner, pour chaque produit, son id, son nom et le chiffre d’affaires total (somme de quantite × prix_unitaire sur toutes les commandes).

#### Étape 3 : Créer un controller ChiffreAffairesController

- Action : /chiffre-affaires
- Appeler la méthode chiffreAffairesParProduit du repository
- Afficher le résultat sous forme de liste :  
  Produit : [nom] | CA : [chiffre d’affaires] €

---

### 4. Exemple de résultat attendu

```
Produit : Stylo | CA : 120 €
Produit : Cahier | CA : 250 €
Produit : Gomme | CA : 60 €

---

### 5. Ce que tu vas apprendre

- Créer des entités et des relations entre elles
- Utiliser une table de relation (commande_produit)
- Faire une requête d’agrégation dans un repository
- Afficher le résultat dans un controller

---
