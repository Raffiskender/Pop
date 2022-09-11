<?php

namespace Poils_o_pattes;

use Poils_o_pattes\Models\Appointements;
use Poils_o_pattes\Models\CustomRequests;
use Poils_o_pattes\Models\Services;

class RoutesAPI
{
	
	public static function create_API_routes(){
		//* Les routes en GET
		$appointement = new Appointements;
		
		//echo ('je suis dans la f° create_API_calendar_routes'); die;
		
		register_rest_route( 'poils-o-pattes/v1', 'test',[
			'methods' => 'GET',
			'callback' => function(){return "coucou !";},
			],
		);
		
		register_rest_route( 'poils-o-pattes/v1', 'calendar',[
			'methods' => 'GET',
			'callback' => [$appointement, 'findAll'],
			],
		);
		register_rest_route( 'poils-o-pattes/v1', 'calendar/day/(?P<day>\d+)',[
			'methods' => 'GET',
			'callback' => [$appointement, 'findByDay'],
			],
		);
		register_rest_route( 'poils-o-pattes/v1', 'calendar/user/(?P<userId>\d+)',[
			'methods' => 'GET',
			'callback' => [$appointement, 'findByUserIdFromAPI'],
			],
		);
		register_rest_route( 'poils-o-pattes/v1', 'calendar/customer/(?P<customerId>\d+)',[
			'methods' => 'GET',
			'callback' => [$appointement, 'findByCustomerIdFromAPI'],
			],
		);

		register_rest_route( 'poils-o-pattes/v1', 'calendar/(?P<appointementId>\d+)',[
			'methods' => 'PUT',
			'callback' => [$appointement, 'changeFromAPI'],
			],
		);
				//* Les routes en POST
		register_rest_route(
				'poils-o-pattes/v1',
				'calendar/',
				[
				'methods' => 'POST',
				'callback' => [$appointement, 'insertNewAppointementFromAPI'],
				]
		);

		//* La methode DELETE
		register_rest_route(
				'poils-o-pattes/v1',
				'calendar/(?P<appointementId>\d+)',
				[
				'methods' => 'DELETE',
				'callback' => [$appointement, 'deleteAppointementFromAPI'],
				]
		);


		//*routes of services managements
		$service = new Services();

		register_rest_route(
				'poils-o-pattes/v1',
				'services',
				[
						'methods' => 'GET',
						'callback' => [$service, 'findAll'],
				]
		);

		register_rest_route(
				'poils-o-pattes/v1',
				'services/(?P<serviceId>\d+)',
				[
						'methods' => 'GET',
						'callback' => [$service, 'findById'],
				]
		);
		
		register_rest_route(
				'poils-o-pattes/v1',
				'services/spa',
				[
						'methods' => 'GET',
						'callback' => [$service, 'findAllSpaServices'],
				]
		);
		register_rest_route(
				'poils-o-pattes/v1',
				'services/toilettage',
				[
						'methods' => 'GET',
						'callback' => [$service, 'findAllGroomingServices'],
				]
		);
		register_rest_route(
				'poils-o-pattes/v1',
				'services',
				[
						'methods' => 'POST',
						'callback' => [$service, 'insertNew'],
				]
		);
		register_rest_route(
				'poils-o-pattes/v1',
				'services/(?P<serviceId>\d+)',
				[
						'methods' => 'PUT',
						'callback' => [$service, 'updateService'],
				]
		);
		register_rest_route(
				'poils-o-pattes/v1',
				'services/(?P<serviceId>\d+)',
				[
						'methods' => 'DELETE',
						'callback' => [$service, 'delete'],
				]
		);

		//* Routes  & endpoints CustomRequests
		register_rest_route(
				'poils-o-pattes/v1',
				'catalog-media',
				[
				'methods' => 'GET',
				'callback' => [CustomRequests::class, 'catalogue'],
				],
		);
		register_rest_route(
				'poils-o-pattes/v1',
				'accessories-media',
				[
				'methods' => 'GET',
				'callback' => [CustomRequests::class, 'accessories'],
				],
		);
		register_rest_route(
				'poils-o-pattes/v1',
				'delicacies-media',
				[
				'methods' => 'GET',
				'callback' => [CustomRequests::class, 'delicacies'],
				],
		);
		register_rest_route(
				'poils-o-pattes/v1',
				'beauty-products-media',
				[
				'methods' => 'GET',
				'callback' => [CustomRequests::class, 'beautyProducts'],
				],
		);
		register_rest_route( 'poils-o-pattes/v1',
			'galery-media',
			[
			'methods' => 'GET',
			'callback' => [CustomRequests::class, 'galery'],
			],
		);
		register_rest_route( 'poils-o-pattes/v1',
			'services-media',
			[
			'methods' => 'GET',
			'callback' => [CustomRequests::class, 'services'],
			],
		);
	}
}