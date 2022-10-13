
<form method='POST' action="index.php?uc=gerer&action=controlemodif">

	<input type='hidden' name='id'  value ="<?php echo $le_membre['id'] ?>">

<label for="nom" class="form-label">Nom :</label>
	<input type='text' id="nom" name='nom' class="form-control" value ="<?php echo $le_membre['nom'] ?>">

<label for="prenom" class="form-label">Prénom :</label>
	<input type='text' id="prenom" name='prenom' class="form-control" value="<?php echo $le_membre['prenom'] ?>">
<br>
<button type="submit" class="btn btn-primary">Modifier</button>
</form>