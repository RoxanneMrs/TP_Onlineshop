<?php

require_once("inc/init.php");

if (!isset($_SESSION["user"])) {
    header("location:connexion.php");
    exit(); // vous assurer que le code après n'est pas exécuté
}

$pseudo = $_SESSION["user"]["pseudo"];
$stmt = $pdo->query("SELECT * FROM members WHERE pseudo = '$pseudo' ");
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $user["id_member"];
$stmt = $pdo->query("SELECT * FROM orders WHERE id_member = '$id' ");

require_once("inc/header.php");

?>

<div class="col-md-12 mb-5">
    <h2 class="text-center">Hi
        <?= $user["first_name"]; ?> , welcome to your profile !
    </h2>
</div>

<div class="card col-md-4">

    <?php if ($user["sexe"] === "m") { ?>
        <img src="./pictures/avatar_male.png" class="card-img-top" alt="Profil de <?= $user["pseudo"]; ?>">
    <?php } else { ?>
        <img src="./pictures/avatar_female.png" class="card-img-top" alt="Profil de <?= $user["pseudo"]; ?>">
    <?php } ?>

    <div class="card-body">
        <h5 class="card-title">
            <?= $user["first_name"]; ?>
        </h5>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item text-center">
            <?= $user["email"]; ?>
        </li>
        <li class="list-group-item text-center">
            <?= $user["address"]; ?>
        </li>
        <li class="list-group-item text-center">
            <?= $user["postal_code"]; ?>
            <?= $user["city"]; ?>
        </li>
    </ul>
</div>

<div class="col-md-4">
    <ul class="list-group">
        <li class="list-group-item text-center">
            <h5>My orders</h5>
        </li>

    </ul>

    <ul class="list-group mt-5">
        <li class="list-group-item text-center">
            <h5>All my orders</h5>
        </li>

        <?php while ($order = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <a href="order-details.php?id_order=<?= $order["id_order"]; ?>">
                <li class="list-group-item text-center">
                    <p>Order n°
                        <?= $order["id_order"]; ?> from the
                        <?= $order["date"]; ?>
                    </p>

                    <?php if ($order["state"] == "in progress") { ?>
                        <p class="badge badge-warning">
                            <?= $order["state"]; ?>
                        </p>
                    <?php } else if ($order["state"] == "sent") { ?>
                            <p class="badge badge-success">
                            <?= $order["state"]; ?>
                            </p>
                    <?php } else { ?>
                            <p class="badge badge-dark">
                            <?= $order["state"]; ?>
                            </p>
                    <?php } ?>
                </li>
            </a>
        <?php } ?>
    </ul>
</div>

<?php
require_once("inc/footer.php");
?>