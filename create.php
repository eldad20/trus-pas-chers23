<?php

session_start();

if(!isset($_SESSION['user']))
{
  header('Location: login.php');
  exit();
}

$success = false;
require 'models/produits-data.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nom = $_POST["nom"];
  $prix = $_POST["prix"];
  $devise = $_POST["devise"];
  $etudiant_id = $_POST["etudiant_id"];

  $image_name = $_FILES["image"]["name"];
  $image_tmp_name = $_FILES["image"]["tmp_name"];

  //deplacer l'image 
  move_uploaded_file($image_tmp_name, "uploads/" . $image_name);

  $produitModel->create($etudiant_id, $nom, $prix, $devise, $image_name);

  $success = true;
}

$page = "create.php";
$title = "Nouveau produits";
$header = "Ajouter un nouveau produit"
?>

<?php require 'composants/head.php'; ?>
<?php require 'composants/nav.php'; ?>
<?php require 'composants/header.php'; ?>
<?php require 'composants/main.php'; ?>


<h1>Publier un nouveau produit</h1>



<form class="max-w-sm mx-auto" action="create.php" method="POST" enctype="multipart/form-data">
  <?php if($success): ?>
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
  <span class="font-medium">Le produit</span> a été bien ajouté.
</div>
<?php endif; ?>
  <div class="mb-5">
    <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du produit</label>
    <input type="text" id="nom" name="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ex : Bracelet" required />
  </div>
  <div class="mb-5">
    <label for="prix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix du produit</label>
    <input type="number" id="prix" name="prix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ex : 5000" required />
  </div>

  <div class="mb-5">
    <label for="devise" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner la devise</label>
    <select id="devise" name="devise" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

      <option>FC</option>
      <option>$</option>
    </select>
  </div>


  <div class="mb-5">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Choisir image du produit
    </label>
    <input name="image"
      class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
      id="image" type="file">

  </div>
  <div class="mb-5">
    <label for="etudiant_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produit
      appartenant a l'etudiant
    </label>

    <select id="etudiant_id" name="etudiant_id"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
      <?php foreach ($etudiants as $etudiant) : ?>

        <option value="<?php echo $etudiant['id'] ?>">
          <?php echo $etudiant['nom'] ?>
        </option>

      <?php endforeach; ?>
    </select>
  </div>

  <button type="submit"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 

font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter</button>
</form>

<?php require 'composants/footer.php'; ?>