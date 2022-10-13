<table class="table">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col"> Modifier</th>
    </tr>
    </thead>
    <tbody>

    <?php
    foreach ($les_membres as $membre)
    {
        $id=$membre['id'];
        ?>

        <tr>
        <td> <?php echo $membre['id']; ?> </td>
        <td> <?php echo $membre['nom']; ?> </td>
        <td> <?php echo $membre['prenom']; ?> </td>
        <td><button><a href="index.php?uc=gerer&action=modifier&id=<?php echo $id?>" type="submit" class="btn btn-primary">Modification</a></button></td>
        </tr>
        <?php
    }

    ?>
    

    </tbody>
</table>
<ul>
    <li><a href='index.php'>retour accueil</a></li>
</ul>