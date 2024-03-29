<?php

require_once("inc/init.php");

// afficher toutes les commandes dans la page profile
// si une commande est in progress => badge orange
// sent badge vert
// delivered badger black

// si je clique sur une commande
// je vais accéder au détails de la commande
// tous les produits associés à la commande
// afficher le montant total de commande

if(isset($_GET["id_order"])) {

    $id_order = $_GET["id_order"];
    $stmt = $pdo->query("SELECT * FROM order_details od 
    INNER JOIN products p ON od.id_product = p.id_product
    WHERE id_order = '$id_order'");
    $smt2 = $pdo->query("SELECT * FROM orders WHERE id_order = '$id_order'");
    $order = $smt2->fetch(PDO::FETCH_ASSOC);

} else {

    header("location:profile.php");
    exit();

}

require_once("inc/header.php");



?>

<h1> Voici le récapitulatif de votre commande N° <?= $_GET["id_order"]; ?> </h1>

<table class="table my-5">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Photo</th>
        </tr>
    </thead>
    <tbody>

        <?php while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td>
                        <?= $product["title"]; ?>
                    </td>
                    <td>
                        <?= $product["quantity"]; ?>
                    </td>
                    <td>
                        <?= $product["price"]; ?>
                    </td>
                    <td> <img style="width:100px" src="<?= $product["picture"]; ?>"
                            alt="<?= $product["title"]; ?>"> </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="5" style="text-align:right">Montant Total :
                    <?= $order["amount"]; ?>€
                </td>
            </tr>

    </tbody>
</table>

<?php
    require_once("inc/footer.php");
?>