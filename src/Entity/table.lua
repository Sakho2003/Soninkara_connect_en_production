+---------------------+      +---------------------+      +-----------------------+      +------------------------+
|        Client       |      |       Commande      |      |         Colis         |      |     FraisExpedition    |
+---------------------+      +---------------------+      +-----------------------+      +------------------------+
| id                  |      | id                  |      | id                    |      | id                     |
| nom                |      | dateCommande        |      | poids                 |      | tarif                  |
| prenom             |      | statut              |      | dimensions           |      | paysExpedition         |
| adresse            |      | client (FK)         |      | description          |      | paysDestination        |
| email              |      |                     |      | commande (FK)         |      +------------------------+
| motDePasse (hash)  |      +---------------------+      | paysExpedition        |
| pays               |                                  | paysDestination       |
+---------------------+                                  +-----------------------+

+---------------------+      +-------------------------+
|       Panier        |      |      ArticlePanier      |
+---------------------+      +-------------------------+
| id                  |      | id                      |
| client (FK)         |      | article (FK)            |
+---------------------+      | quantite                |
                             +-------------------------+

+---------------------+
|     SuiviColis     |
+---------------------+
| id                  |
| colis (FK)          |
| statut              |
| dateHeureSuivi      |
+---------------------+


Table Utilisateur
| ID Utilisateur | Nom     | Prenom  | Email            | Mot de passe hashé | Adresse de livraison par défaut |
|----------------|---------|---------|------------------|---------------------|---------------------------------|
| 1              | John    | Doe     | john@email.com   | hashed_password    | 123 Rue Principale, Paris       |
| 2              | Jane    | Smith   | jane@email.com   | hashed_password    | 456 Avenue Centrale, Lyon       |



Table TypeEmballage
| ID TypeEmballage | Nom            | Description                    |
|------------------|----------------|--------------------------------|
| 1                | Boîte          | Boîte en carton standard       |
| 2                | Enveloppe      | Enveloppe à bulles             |


Table Commande
| ID Commande | ID Utilisateur | Adresse de destination | Poids du colis | ID TypeEmballage | État de la commande | Date de création        | Date de mise à jour de l'état | Frais d'expédition |
|-------------|-----------------|------------------------|----------------|------------------|----------------------|--------------------------|-------------------------------|---------------------|
| 1           | 1               | Rue de Paris, France   | 2 kg           | 1                | En attente           | 2023-01-01 08:00:00      | 2023-01-02 10:30:00           | 10.00 EUR           |
| 2           | 2               | Avenue de Lyon, Suisse | 5 kg           | 2                | En cours d'expédition | 2023-01-02 10:30:00      | 2023-01-03 12:45:00           | 15.00 EUR           |


Table EtapeCommande
| ID Etape | ID Commande | État de la commande | Date de mise à jour     |
|----------|-------------|----------------------|-------------------------|
| 1        | 1           | En attente           | 2023-01-02 10:30:00     |
| 2        | 2           | En cours d'expédition | 2023-01-03 12:45:00     |




Client = {
    id = "Identifiant unique du client",
    nom = "Nom du client",
    prenom = "Prénom du client",
    adresse = "Adresse du client",
    email = "Adresse e-mail du client",
    password = "Mot de passe (haché) du client",
    pays = "Pays du client",
    createdAt = "Date de création du compte",
    verifiedAt = "Date de vérification du compte",
    updatedAt = "Date de mise à jour du compte",
    isVerified = "Statut de vérification du compte"
}


TypeEmballage = {
    id = "Identifiant unique du type d'emballage",
    nom = "Nom du type d'emballage",
    description = "Description du type d'emballage"
}

Colis = {
    id = "Identifiant unique du colis",
    poids = "Poids du colis",
    dimensions = "Dimensions du colis",
    description = "Description du colis",
    idCommande = "Référence à la commande (clé étrangère)"
}


Commande = {
    id = "Identifiant unique de la commande",
    dateCommande = "Date de la commande",
    statut = "Statut de la commande",
    poids = "Poids du colis",
    idClient = "Référence au client (clé étrangère)",
    idTypeEmballage = "Référence au type d'emballage (clé étrangère)",
    fraisExpedition = "Référence aux frais d'expédition (clé étrangère)",
    adresseDestination = "Adresse de destination du colis",
    paysExpedition = "Pays d'expédition",
    paysDestination = "Pays de destination"
}

SuiviColis = {
    id = "Identifiant unique du suivi du colis",
    idColis = "Référence au colis (clé étrangère)",
    statut = "Statut du suivi du colis",
    dateHeureSuivi = "Date et heure du suivi du colis"
}


FraisExpedition = {
    id = "Identifiant unique des frais d'expédition",
    tarif = "Tarif des frais d'expédition",
    paysExpedition = "Pays d'expédition",
    paysDestination = "Pays de destination"
}

ReservationColis = {
    id = "Identifiant unique de la réservation",
    destination = "Destination du colis",
    dimensions = "Dimensions du colis",
    createdAt = "Date de création de la réservation",
    updatedAt = "Date de mise à jour de la réservation",
}