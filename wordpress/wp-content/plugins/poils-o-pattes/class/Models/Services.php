<?php

namespace Poils_o_pattes\Models;

class Services extends CoreModel
{
    public const TABLE_NAME = 'services';

    public function createTable()
    {
        $charset_collate = $this->wpdb->get_charset_collate();
        $sql = 'CREATE TABLE `' . self::TABLE_NAME . "` (
			`service_id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`nom_service` varchar(64) NOT NULL,
			`type_service` varchar(64) NOT NULL,
			`prix_petit` int unsigned NOT NULL,
			`prix_moyen` int unsigned NOT NULL,
			`prix_grand` int unsigned NOT NULL
		) " . $charset_collate;

        $this->wpdb->query($sql);
    }

    public function deleteTable()
    {
        $sql = 'DROP TABLE `' . self::TABLE_NAME . '`';
        $this->wpdb->query($sql);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM ' . self::TABLE_NAME;
        return $this->wpdb->get_results($sql);
    }

    public function findById($params)
    {
        $serviceId = $params['serviceId'];
        $sql = "SELECT * FROM `services` WHERE `service_id` = " . $serviceId;
        return $this->wpdb->get_results($sql);
    }

    public function findAllSpaServices()
    {
        //$serviceName = $params['serviceName'];
			
        $sql = "SELECT * FROM `services` WHERE `type_service` = 'spa'";
        return $this->wpdb->get_results($sql);
    }
		
    public function findAllGroomingServices()
    {
        $sql = "SELECT * FROM `services` WHERE `type_service` = 'toilettage'";
        return $this->wpdb->get_results($sql);
    }

    public function insertNew($request)
    {
        $params = $request->get_params('nomService', 'typeService', 'prixPetit', 'prixMoyen', 'prixGrand');
        $data = [
            'nom_service'  => $params["nomService"],
            'type_service' => $params["typeService"],
            'prix_petit'   => $params["prixPetit"],
            'prix_moyen'   => $params["prixMoyen"],
            'prix_grand'   => $params["prixGrand"],
            //'created_at'   => date('Y-m-d H:i:s')
        ];
    }

    public function insertDatasInDB($servicesList)
    {
        foreach ($servicesList as $currentService) {
            //echo $currentService["nomService"];
            $data = [
                'nom_service'  => $currentService["nomService"],
                'type_service' => $currentService["typeService"],
                'prix_petit'   => $currentService["prixPetit"],
                'prix_moyen'   => $currentService["prixMoyen"],
                'prix_grand'   => $currentService["prixGrand"],
                //'created_at'   => date('Y-m-d H:i:s')
            ];

            $this->wpdb->insert(self::TABLE_NAME, $data);
        }

        return 'success';
    }

    //TODO : function update pour methode PUT
    public function update($request)
    {
        $params = $request->get_params('nomService', 'typeService', 'prixPetit', 'prixMoyen', 'prixGrand', [self::class, 'content'], );
        $data = [
            'nom_service'  => $params["nomService"],
            'type_service' => $params["typeService"],
            'prix_petit'   => $params["prixPetit"],
            'prix_moyen'   => $params["prixMoyen"],
            'prix_grand'   => $params["prixGrand"],
            'updated_at'   => date('Y-m-d H:i:s')
        ];
        $where = ['service_id' => $params['serviceId']];
        return $this->wpdb->update(self::TABLE_NAME, $data, $where);
    }

    //delete a service
    public function delete($request)
    {
        $serviceId = $request->get_param('serviceId');
        $data = [
            "service_id" => $serviceId
        ];
        return $this->wpdb->delete(self::TABLE_NAME, $data);
    }
}