<form action ="index.php?uc=gerer&action=valideSupp" method="POST" >
<label for="personneSupp">Choisissez la personne à supprimer :</label>

<select name="courseName">
   <option>Selectionner une personne</option>
  <?php 
  foreach ($les_membres as $option) : ?>
    <option value="<?php echo $option['id']; ?>"><?php echo $option['nom']." ".$option['prenom']; ?></option>
 <?php endforeach ?>

</select>

<button type="submit" class="btn btn-primary">Supprimer</button>

</form>
<br>
<ul>
    <li><a href='index.php'>retour accueil</a></li>
</ul>