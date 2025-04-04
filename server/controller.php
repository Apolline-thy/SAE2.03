<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");

function readMoviesController(){
    $movies = getAllMovies();
    return $movies;
}

function addMovieController(){
  // Lecture des données du formulaire
  $title = $_REQUEST['title'];
  $director = $_REQUEST['director'];
  $image = $_REQUEST['image'];
  $year = $_REQUEST['year'];
  $length = $_REQUEST['length'];
  $description = $_REQUEST['description'];
  $category = $_REQUEST['category'];
  $trailer = $_REQUEST['trailer'];
  $min_age = $_REQUEST['min_age'];

  // Vérification que tous les champs obligatoires sont présents
  if (empty($title) || empty($director) || empty($image) || empty($year) ||  empty($length) || empty($description) || empty($category) || empty($trailer) || empty($min_age)) {
    return "Tous les champs doivent être remplis.";
  }

  // Appel de la fonction pour ajouter le film à la base de données
  $ok = addMovie($title, $director, $image, $year, $length, $description, $category, $trailer, $min_age);

  // Vérification du succès de l'opération
  if ($ok != 0) {
    return "Le film \"$title\" a été ajouté avec succès.";
  } else {
    return "Une erreur s'est produite lors de l'ajout du film.";
  }
}
