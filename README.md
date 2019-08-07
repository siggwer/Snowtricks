# Snowtricks

## To do

* Implémentation des entités
    * Trick
    * Category
    * Comment
    * Picture
    * Video
    * User
* Configurer l'environnement
    * Création du `.env.local`
    * Création de la base de données
    * Mise à jour du schéma de la base de données
    * Création de jeux de données (fixtures)
    * Création d'un script **composer** pour faciliter la mise en place de l'environnement
* Préparer le front
    * Création du template `base.html.twig`
    * Configuration de twig pour les formulaires
* Implémentation des features : 
    * Affichage de la page d'accueil :
        * Règles de gestion :
            * Afficher 6 tricks
            * Avoir un bouton `Load more` : **Appel Ajax**
    * Affichage du détail d'un article :
        * Règles de gestion :
            * Pagination des commentaires
            * Affichage des commentaires par ordre chronologique décroissant
    * Poster un commentaire
    * Ajouter un trick
    * Modifier un trick
    * Supprimer un trick
    * Inscription
    * Connexion
    * Déconnexion
    * Modifer mon avatar
    * Customisation des pages d'erreur
    
    
## Algèbre de boule

| $isSubmitted | $isValid | $isSubmitted && $isValid |
|--------------|----------|--------------------------|
| 0            | 0        | 0                        |
| 1            | 0        | 0                        |
| 1            | 1        | 1                        |
| 0            | 1        | 0                        |
"# snow" 
