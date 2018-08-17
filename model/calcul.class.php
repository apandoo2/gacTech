<?php
class Calcul extends Db {

    function __construct() {
        $this->type_facturation = 'sms';
        $this->start_time = '08:00';
        $this->end_time = '18:00';
        $this->date_facturation = '2012-02-15';
    }

    /**
     * Method to Get Total number of calls made by Type facturation 'appel'
     * @return string total time in h:m:s;
     */

    function getTotalCallMadeByDate(Db $bdd)
    {
        $this->type_facturation = 'appel';
        $datas_duree_reelles = $bdd->getAll("SELECT SUM(time_to_sec(cast(Dure_vol_reel as time))) as sec 
                                         FROM detail_appel
                                         where Date_facturation >='" . $this->date_facturation . "' 
                                         and Type_facturation like '%" . $this->type_facturation . "%'
                                         order by Date_facturation DESC");

        foreach ($datas_duree_reelles as $datas_duree_reelle) {
            $total_seconds =  $datas_duree_reelle['sec'];
        }

        $format_seconds_to_hours = sprintf('%02d:%02d:%02d', ($total_seconds / 3600), ($total_seconds / 60 % 60), 
                                           $total_seconds % 60);
        return $format_seconds_to_hours;
    }

    /**
     * Method to get top 10 datas not between two time intervals
     * @return array array of top 10 not between two time intervals
     */
    function getTopTenVolume(Db $bdd){
        $datas_top_tens = $bdd->getAll("SELECT SUM(Dure_vol_facturee) AS Dure_vol_facturee,Compte_facture,Numero_abonnee,  
                                       Numero_facture,Type_facturation,Heure_facturation
                                       FROM detail_appel
                                       WHERE Heure_facturation NOT BETWEEN '" . $this->start_time . "' AND '" . $this->end_time."'
                                       GROUP BY  Numero_abonnee
                                       ORDER BY  sum(Dure_vol_facturee) DESC
                                       LIMIT 10");
        return $datas_top_tens;
    }

    /**
     * Method to total number of calls per type facturation
     * @return integer total number of calls
     */
    function getTotalDataByTypeFacturation(Db $bdd) {
        $data = $bdd->getAll("SELECT * FROM detail_appel WHERE type_facturation LIKE '%" . $this->type_facturation . "%'");
        $count  = count($data);
        return $count;
    }

    /**
     * Method to check to count number of data in table detail_appel
     * @return integer total number records in table detail_appel
     */
    function checkIfDatabaseIsUploaded(Db $bdd) { 
        $data = $bdd->getAll("SELECT * FROM detail_appel");
        $count  = count($data);
        return $count;
    }
}
