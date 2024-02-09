<?php

// Accueil du BACK OFFICE

require_once("../inc/init.php");

// GÉRER LA MODIFICATION DU STATUS

if ($_POST) {

    $id_order = $_POST["id_order"];
    $newState = $_POST["state"];

    // update

    $count = $pdo->exec("UPDATE orders SET state = '$newState' WHERE id_order = '$id_order'");

    if ($count >= 1) {
        $content = "<div class='alert alert-success'>
            Votre commande n° $id_order a été mise à jour !
        </div>";
    }
}

// GÉRER L'AFFICHAGE DES COMMANDES
if ($_GET) {

    if (isset($_GET["id_order"]) && $_GET["id_order"] !== "") {
        
        // récupérer la commande par son id_order
        $id = $_GET["id_order"];
        $stmt = $pdo->query("SELECT * FROM orders WHERE id_order = '$id' ");

    // faudra récupérer les commandes par status
    } else if (isset($_GET["state"]) && $_GET["state"] !== "none") {

        $state = $_GET["state"];
        $stmt = $pdo->query("SELECT * FROM orders WHERE state = '$state' ");

    }

} else {

    $stmt = $pdo->query("SELECT * FROM orders");

}




require_once("inc/header.php");

?>

<?= $content; ?>
<!-- BODY -->
<h1 class="mb-5 text-center">Welcome to the management of your orders in the backOffice</h1>

<div class="w-100"> </div>

<h2>List of orders <span class="badge badge-secondary"></span></h2>

<div class="w-100"> </div>

<form class="row col-md-12 align-items-center justify-content-center m-5" method="get" action="">
    <select class="form-control col-md-4" name="state">
        <option value="none" disabled="" <?= !isset($_GET["state"]) ? "selected" : "" ?>> Choose type of order </option>

        <option value="in progress" <?= isset($_GET["state"]) && $_GET["state"] === "in progress" ? "selected" : "" ?>> In
            progress </option>

        <option value="sent" <?= isset($_GET["state"]) && $_GET["state"] === "sent" ? "selected" : "" ?>> Sent </option>

        <option value="delivered" <?= isset($_GET["state"]) && $_GET["state"] === "delivered" ? "selected" : "" ?>>
            Delivered </option>
    </select>

    <p class="text-center mb-0 mr-3 ml-3">Or</p>

    <input type="text" name="id_order" class="form-control col-md-4" id="id_order" aria-describedby="id_order"
        placeholder="Enter an order number">

</form>


<table class="table mb-5">
    <thead class="thead-dark">
        <tr>
            <th scope="col"> id_order </th>
            <th scope="col"> id_member </th>
            <th scope="col"> amount </th>
            <th scope="col"> date </th>
            <th scope="col"> state </th>
        </tr>
    </thead>
    <tbody>

        <?php while ($order = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td>
                    <?= $order["id_order"]; ?>
                </td>
                <td>
                    <?= $order["id_member"]; ?>
                </td>
                <td>
                    <?= $order["amount"]; ?>
                </td>
                <td>
                    <?= $order["date"]; ?>
                </td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="id_order" value="<?= $order["id_order"]; ?>">
                        <input type="hidden" name="modifyState">
                        <select class="form-control" name="state">
                            <option value="in progress" <?= $order["state"] === "in progress" ? "selected" : "" ?>> In progress
                            </option>
                            <option value="sent" <?= $order["state"] === "sent" ? "selected" : "" ?>> Sent </option>
                            <option value="delivered" <?= $order["state"] === "delivered" ? "selected" : "" ?>> Delivered
                            </option>
                        </select>
                    </form>
                </td>
            </tr>

        <?php } ?>

    </tbody>
</table>


<?php
require_once("inc/footer.php");
?>