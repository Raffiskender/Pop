<?php

namespace Poils_o_pattes\Models;

use WP_Query;

class Appointements extends CoreModel
{
    public const TABLE_NAME = 'appointements';
    public function createTable()
    {
        $charset_collate = $this->wpdb->get_charset_collate();
        $sql = 'CREATE TABLE `' . self::TABLE_NAME . "` (
			`appointement_id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`customer_id` int unsigned NOT NULL,
			`dog_id` int unsigned NOT NULL,
			`skatholer_id` int unsigned NOT NULL,
			`day` DATE NOT NULL,
			`start_time` TIME NOT NULL,
			`stop_time`  TIME NOT NULL,
			`created_at` TIMESTAMP NOT NULL,
			`updated_at` TIMESTAMP NOT NULL
		) " . $charset_collate;
		
		//var_dump($sql); die;
		$this->wpdb->query( $sql );
	}
	
	public function deleteTable()
	{
		$sql = 'DROP TABLE `' . self::TABLE_NAME . '`';
		$this->wpdb->query($sql);
	}
	
	public function findAll()
	{
		$sql = "SELECT * FROM `" . self::TABLE_NAME . "`";
		return $this->wpdb->get_results($sql);
	}
	
	public function findByDay($params)
	{
		$day = $params['day'];
		
		$dayName = date('l', strtotime($day));
		
		//* The day param comes like "YYYYMMDD". Those 2 lines formats it like "YYYY-MM-DD" to be readable by the DB 
		$day=substr_replace($day,'-',-2,0);
		$day=substr_replace($day,'-',-5,0);
				
		$sql = "SELECT * FROM `". self::TABLE_NAME ."` WHERE day = \"$day\" ORDER BY start_time";

		$result = $this->wpdb->get_results($sql);
		
if ($dayName == 'Sunday' || $dayName == 'Monday') {
    return [
			[ 'readableTime' => 'FERMÉ',
				'inDBtime'     => '--',
				'available'    => '0'],
    ];
}elseif ($dayName == 'Friday'){
			$tableau = [
			[ 'readableTime' => '9h30',
				'inDBtime'     => '09:30:00',
				'available'    => '1'],
			[ 'readableTime' => '10h30',
				'inDBtime'     => '10:30:00',
				'available'    => '1'],
			[ 'readableTime' => '11h30',
				'inDBtime'     => '11:30:00',
				'available'    => '1'],
			[ 'readableTime' => '12h30',
				'inDBtime'     => '12:30:00',
				'available'    => '1'],
			[ 'readableTime' => '13h00',
				'inDBtime'     => '13:00:00',
				'available'    => '1'],
			[ 'readableTime' => '14h00',
				'inDBtime'     => '14:00:00',
				'available'    => '1'],
			[ 'readableTime' => '15h00',
				'inDBtime'     => '15:00:00',
				'available'    => '1'],
			[ 'readableTime' => '16h00',
				'inDBtime'     => '16:00:00',
				'available'    => '1'],
    ];
				
			foreach ($result as $currentAppointement) {
				foreach ($tableau as $currentTime => $currentValue) {
					if ($currentAppointement->start_time == $currentValue['inDBtime']) {
						$tableau[$currentTime]['available'] = "0";
						};
					}
				}		
			
			return $tableau;
			
		}elseif ($dayName == 'Saturday'){
			$tableau = [
					[ 'readableTime' => '9h30',
				'inDBtime'     => '09:30:00',
				'available'    => '1'],
			[ 'readableTime' => '10h30',
				'inDBtime'     => '10:30:00',
				'available'    => '1'],
			[ 'readableTime' => '11h30',
				'inDBtime'     => '11:30:00',
				'available'    => '1'],
			[ 'readableTime' => '12h30',
				'inDBtime'     => '12:30:00',
				'available'    => '1'],
			[ 'readableTime' => '13h30',
				'inDBtime'     => '13:00:00',
				'available'    => '1'],
			[ 'readableTime' => '14h30',
				'inDBtime'     => '14:00:00',
				'available'    => '1'],
			[ 'readableTime' => '15h00',
				'inDBtime'     => '15:00:00',
				'available'    => '1'],
			[ 'readableTime' => '16h00',
				'inDBtime'     => '16:00:00',
				'available'    => '1'],
			[ 'readableTime' => '17h00',
				'inDBtime'     => '17:00:00',
				'available'    => '1'],
    ];
			
			foreach ($result as $currentAppointement) {
				foreach ($tableau as $currentTime => $currentValue) {
					if ($currentAppointement->start_time == $currentValue['inDBtime']) {
						$tableau[$currentTime]['available'] = "0";
						};
					}
				}		
			return $tableau;
	
		}else{
			$tableau = [
					[ 'readableTime' => '9h30',
				'inDBtime'     => '09:30:00',
				'available'    => '1'],
			[ 'readableTime' => '10h30',
				'inDBtime'     => '10:30:00',
				'available'    => '1'],
			[ 'readableTime' => '11h30',
				'inDBtime'     => '11:30:00',
				'available'    => '1'],
			[ 'readableTime' => '14h00',
				'inDBtime'     => '14:00:00',
				'available'    => '1'],
			[ 'readableTime' => '15h00',
				'inDBtime'     => '15:00:00',
				'available'    => '1'],
			[ 'readableTime' => '16h00',
				'inDBtime'     => '16:00:00',
				'available'    => '1'],
			[ 'readableTime' => '17h00',
				'inDBtime'     => '17:00:00',
				'available'    => '1'],
			[ 'readableTime' => '18h00',
				'inDBtime'     => '18:00:00',
				'available'    => '1'],
    ];
			
			foreach ($result as $currentAppointement) {
				foreach ($tableau as $currentTime => $currentValue) {
					if ($currentAppointement->start_time == $currentValue['inDBtime']) {
						$tableau[$currentTime]['available'] = "0";
						};
					}
				}		
			return $tableau;
	
		}		
	}

	public function findByUserIdFromAPI($params)
	{
		$userId = $params['userId'];
			
		$sql = "SELECT * FROM `" . self::TABLE_NAME . "` WHERE `skatholer_id` = " . $userId ;

		return $this->wpdb->get_results($sql);
	}
	
	public function findByCustomerIdFromAPI($params)
	{
		$customerId = $params['customerId'];
		
    $arguments = ['post_type' => 'dog',
    'posts_per_page' => -1];
    $allDogs = new WP_Query($arguments);
		$dogsTable = [];
		
		foreach ($allDogs->posts as $currentDog) {
			array_push($dogsTable, [
			'id' => $currentDog->ID,
			'ownerId' => $currentDog->post_author
			]);
		}

		$customerHasADog = null;
		foreach ($dogsTable as $currentDog) {
			if ($currentDog['ownerId'] == $customerId) {
					$customerHasADog = true;
					break;
			}
		}

		if ($customerHasADog) {
			$tableName = self::TABLE_NAME;
			$sql = "SELECT `customer_id`, `dog_id`, `wp_posts`.`post_title` AS `dog_name`, `day`, `start_time` FROM `$tableName` JOIN `wp_posts` ON `$tableName`.`dog_id`=`wp_posts`.`ID` WHERE `$tableName`.`customer_id` = $customerId ";
			return $response = $this->wpdb->get_results($sql);
		}
		
		else{
			$sql="SELECT `customer_id`, `dog_id`, `day`, `start_time` FROM " . self::TABLE_NAME . " WHERE `customer_id` = $customerId";
			$response = $this->wpdb->get_results($sql);
			foreach ($response as $currentData => $currentValue) {
				$currentValue->{"dog_name"} = '';
			}
			return $response;
			
		}
		
	}

	public function changeFromAPI( $request )
	{
    $params = $request->get_params('appointementId', 'customerId', 'dogId', 'skatholerId', 'day', 'startTime', 'stopTime', 'createdAt');
		
		$rowNb = ['appointement_id' => $params["appointementId"]];

		$data=['updated_at'   =>  date('Y-m-d H:i:s')];
		
		($params["customerId"]) != null ? $data['customer_id'] = $params["customerId"]  : '';
		($params["dogId"])      != null ? $data['dog_id']      = $params["dogId"]       : '';
		($params["skatholerId"])!= null ? $data['skatholer_id']= $params["skatholerId"] : '';
		($params["day"])        != null ? $data['day']         = $params["day"] : '';
		($params["startTime"])  != null ? $data['start_time']  = $params["startTime"]   : '';
		($params["stopTime"])   != null ? $data['stop_time']   = $params["stopTime"]    : '';
		
		return $this->wpdb->update( self::TABLE_NAME, $data, $rowNb);
	}

	public function insertNewAppointementFromAPI( $request )
	{
    $params = $request->get_params('customerId', 'dogId', 'skatholerId', 'day', 'startTime', 'stopTime');

    $data = [
    'customer_id'  => $params["customerId"],
    'dog_id'       => $params["dogId"],
    'skatholer_id' => $params["skatholerId"],
    'day'          => $params["day"],
    'start_time'   => $params["startTime"],
    'stop_time'    => $params["stopTime"],
    'created_at'   =>  date('Y-m-d H:i:s')
     ];

    return $this->wpdb->insert(self::TABLE_NAME, $data);
}
/* requête de test dans insomnia
{
    "customerId": "2",
    "dogId": "45",
    "skatholerId": "1",
    "startTime": "1231150062",
    "stopTime": "2022-12-31 00:00:00"
}

*/
    public function findByUserIdSortedByDate($userId)
    {
        $sql = "SELECT * FROM `" . self::TABLE_NAME . "`WHERE `skatholer_id` = $userId OR `skatholer_id` = 0 ORDER BY `day` ASC, `start_time` ASC;";

        return $this->wpdb->get_results($sql);
    }
		
    public function deleteAppointementFromAPI($request)
    {
			$params = $request->get_params('appointementId');
		
			$appointementId = $params["appointementId"];
        $sql = "DELETE FROM `appointements` WHERE `appointements`.`appointement_id` =" . $appointementId;
        return $this->wpdb->query($sql);
			
    }
		
		
}