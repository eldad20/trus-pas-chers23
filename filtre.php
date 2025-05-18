<?php
session_start();
require 'models/produits-data.php';

$etudiantModel = new EtudiantModel();
$etudiants = $etudiantModel->all();

$title = 'Filtrage';
$page = "filtre.php";

$etudiant_id = $_GET['etudiant'] ?? 1;

$etudiant = $etudiantModel->find($etudiant_id);
$nom_etudiant = $etudiant ? $etudiant['nom'] : "";


if ($etudiant === null) {
    $header = "Aucun étudiant trouvé !!";
} else {

    $header = 'Filtre des produits de : ' . $nom_etudiant;
}

$produitModel = new ProduitModel;
$produits = $produitModel->filterByEtudiantId($etudiant_id);



?>

<?php require 'composants/head.php'; ?>
<?php require 'composants/nav.php'; ?>
<?php require 'composants/header.php'; ?>
<?php require 'composants/main.php'; ?>

<div class="mb-6">


    <?php
    $etudiant_actif = $_GET['etudiant'] ?? null;
    ?>


    <div class="mb-6 ">
        <?php foreach ($etudiants as $etudiant): ?>
            <?php if ($etudiant['id'] == $etudiant_id): ?>
                <span class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">
                    <?php echo $etudiant['nom']; ?></span>
            <?php else: ?>
                <a href="filtre.php?etudiant=<?php echo $etudiant['id']; ?>" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-blue-400 border border-blue-400 inline-flex items-center justify-center">
                    <?php echo $etudiant['nom']; ?></a>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>


    <h1 class="text-2xl font-bold text-center my-4">Produits appartenant à : <?php echo htmlspecialchars($nom_etudiant); ?></h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 px-4">

        <?php foreach ($produits as $produit) : ?>
            <?php if ($produit['etudiant_id'] == $etudiant_id) : ?>
                <?php $imagePath = "uploads/" . $produit['image']; ?>

                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="p-8 rounded-t-lg" src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>" />
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                <?php echo htmlspecialchars($produit['nom']); ?>
                            </h5>
                        </a>
                        <div class="flex items-center mt-2.5 mb-5">
                            <!-- Exemple d'étoiles fixes -->
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <svg class="w-4 h-4 <?= $i < 4 ? 'text-yellow-300' : 'text-gray-200 dark:text-gray-600' ?>" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 ...Z" />
                                </svg>
                            <?php endfor; ?>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-sm ms-3">5.0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white"><?php echo $produit['prix']; ?>€</span>
                            <a href="contact.php" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Ajouter au panier
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>

    <?php require 'composants/footer.php'; ?>