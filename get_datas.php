<?php
include('model/db.class.php'); // call db.class.php
include('model/calcul.class.php');
$bdd = new Db(); // create a new object, class db()
$calcul = new Calcul(); // create a new object, class db()

//check if data is already uploaded
$total_records = $calcul->checkIfDatabaseIsUploaded($bdd);

//2.1 Retrouver la durée totale réelle des appels effectués après le 15/02/2012 (inclus)
$total_calls_per_hms = $calcul->getTotalCallMadeByDate($bdd);

//2.2 Retrouver le TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné.
$datas_top_tens = $calcul->getTopTenVolume($bdd);

// //2.3 Retrouver la quantité totale de SMS envoyés par l'ensemble des abonnés
$datas_quantite_sms = $calcul->getTotalDataByTypeFacturation($bdd);


?>

<?php if ($total_records == 0) :?>
   <script>alert("Please upload the CSV file");location.reload();</script>  
   <?php die();?>
<?php endif;?>

<!-- Display the results -->
<p>Durée totale réelle des appels effectués après le 15/02/2012 (inclus) :<?= $total_calls_per_hms; ?></p>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Durée volume facturée</th>
      <th scope="col">Compte</th>
      <th scope="col">Numéro Abonné</th>
      <th scope="col">Numéro Facture</th>
      <th scope="col">Type Facturation</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($datas_top_tens as $datas_top_ten) :?>
    <tr>
      <td><?= $datas_top_ten['Dure_vol_facturee'];?></td>
      <td><?= $datas_top_ten['Compte_facture'];?></td>
      <td><?= $datas_top_ten['Numero_abonnee'];?></td>
      <td><?= $datas_top_ten['Numero_facture'];?></td>
      <td><?= $datas_top_ten['Type_facturation'];?></td>
    </tr>
  <?php endforeach;?>
  </tbody>
</table>
<p>Quantité totale de SMS envoyés par l'ensemble des abonnés : <?= $datas_quantite_sms;  ?></p>
