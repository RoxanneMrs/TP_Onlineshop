<?php if($elemnForPaginationEnCours["pages"] > 0) { ?>

<nav class="d-flex flex-column justify-content-center align-items-center">
    <ul class="pagination">
        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
        <li class="page-item <?= ($elemnForPaginationEnCours["currentPage"] == 1) ? "disabled" : "" ?>">
            <a href="?page=<?= $elemnForPaginationEnCours["currentPage"] - 1 ?>" class="page-link">Précédente</a>
        </li>
        <?php for($page = 1; $page <= $elemnForPaginationEnCours["pages"]; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($elemnForPaginationEnCours["currentPage"] == $page) ? "active" : "" ?>">
                <a href="?page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
        <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($elemnForPaginationEnCours["currentPage"] == $elemnForPaginationEnCours["pages"]) ? "disabled" : "" ?>">
            <a href="?page=<?= $elemnForPaginationEnCours["currentPage"] + 1 ?>" class="page-link">Suivante</a>
        </li>
    </ul>
</nav>

<?php } ?>