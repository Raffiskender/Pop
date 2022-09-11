<?php

namespace Poils_o_pattes\Controllers;

use Poils_o_pattes\Controllers\CoreController;

class Appointements extends CoreController
{
    public const TABLE_NAME = 'appointements';
    public function findAll()
    {
        $sql = "SELECT * FROM `" . self::TABLE_NAME . "`";
        return $this->wpdb->get_results($sql);
    }
    public function findByUserId($params)
    {
        $userId = $params['userId'];
        $sql = "SELECT * FROM `appointement` WHERE `customer_id` = " . $userId ;
        return $this->wpdb->get_results($sql);
    }
    public function insertNewAppointement($request)
    {
        $params = $request->get_params('customerId', 'dogId', 'skatholerId', 'startTime', 'stopTime');
        $data = [
        'customer_id'  => $params["customerId"],
        'dog_id'       => $params["dogId"],
        'skatholer_id' => $params["skatholerId"],
        'start_time'   => $params["startTime"],
        'stop_time'    => $params["stopTime"],
        'created_at'   =>  date('Y-m-d H:i:s')
         ];
        return $this->wpdb->insert(self::TABLE_NAME, $data);
    }

    //* This function delets an appointement.
    public function deleteAppointement($request)
    {
        $appointementId = $request->get_param('appointementId');
        // Tableau de correspondance colonne => valeur
        $data = [
            "appointement_id" => $appointementId
        ];
        return $this->wpdb->delete(
            self::TABLE_NAME,
            $data
        );
    }
}