<?php

namespace Poils_o_pattes\Models;

class CustomRequests extends CoreModel
{
	public static function catalogue(){
		return [
			[ 'title'    => 'Accessoires',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/accessories.png',
				'link'     => '/catalogue/accessoires'],
			[ 'title'    => 'Produits de beauté',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/beautyproduct.png',
				'link'     => '/catalogue/produits-de-beaute'],
			[ 'title'    => 'Gourmandises',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/delicacies.png',
				'link'     => '/catalogue/gourmandises'],
		];
	}
	
	public static function accessories(){
		return [
			[ 'title'    => 'Vêtements',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/clothes.png'],
			[ 'title'    => 'Jouets',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/toys.png'],
			[ 'title'    => 'Paniers',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/basckets.png'],
			[ 'title'    => 'Autres',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/others.png'],
		];
	}
	public static function delicacies(){
		return [
			[ 'title'    => 'Os',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/bones.png'],
			[ 'title'    => 'Friandises',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/friendises.png'],
			[ 'title'    => 'Bâtons à mâcher',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/chewsticks.png'],
			
		];
	}
	public static function beautyProducts(){
		return [
			[ 'title'    => 'Shampoings',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/shampoos.png'],
			[ 'title'    => 'Soins des oreilles',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/ears.png'],
			[ 'title'    => 'Soins des coussinets & truffes',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/padsandtruffle.png'],
		];
	}

	public static function galery(){
		return [
			[ 'category'    => 'wash',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriewash1.jpg'],
			[ 'category'    => 'wash',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriewash2.jpg'],
			[ 'category'    => 'wash',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriewash3.jpg'],
			[ 'category'    => 'wash',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriewash4.jpg'],
			
			[ 'category'    => 'cut',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriecut1.jpg'],
			[ 'category'    => 'cut',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriecut2.jpg'],
			[ 'category'    => 'cut',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriecut3.jpg'],
			[ 'category'    => 'cut',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriecut4.jpg'],
			
			[ 'category'    => 'brush',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriebrush1.jpg'],
			[ 'category'    => 'brush',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriebrush2.jpg'],
			[ 'category'    => 'brush',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriebrush3.jpg'],
			[ 'category'    => 'brush',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/08/galeriebrush4.jpg'],
		];
	}
	
	public static function services(){
		return [
			[ 'title'    => 'Toilettage',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/09/grooming.png',
				'link'     => '/services/toilettage'],
			[ 'title'    => 'Spa',
				'imageURL' => 'https://poilsopattesbackend.raffiskender.com/wp-content/uploads/2022/09/spa.png',
				'link'     => '/services/spa'],
		];
	}
	
		
}