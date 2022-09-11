<?php

namespace Poils_o_pattes\CustomMenus;

use Poils_o_pattes\Models\Appointements;
use WP_Query;

class Calendar
{
	public function createMenu(){
		add_menu_page("Calendrier", "Calendrier", "edit_posts", "calendrier", [self::class, 'content'], 'dashicons-calendar-alt', 25);
	}
	
	static function content(){
    ?>
	    <link rel="stylesheet" href="../wp-content/plugins/poils-o-pattes/class/CustomMenus/Calendar/style.css">

		<h1>Bienvenue dans votre gestionnaire de rendez-vous <?=wp_get_current_user()->user_firstname?> !</h1>
		<?php

        $appointements = new Appointements();
    $arguments = ['post_type' => 'dog',
    'posts_per_page' => -1];

    $allDogs = new WP_Query($arguments);
    
		$dogsTable = [];
		
    foreach ($allDogs->posts as $currentDog){
			array_push($dogsTable, [
			'id' => $currentDog->ID,
			'name' => $currentDog->post_title,
			'owner' => $currentDog->post_author
			]);
		};
		
		$dogsInArrayOnJson = json_encode($dogsTable);

		$mesRendevs = $appointements->findByUserIdSortedByDate(get_current_user_id());

		// Dates in french
		$semaine = array(" Dimanche "," Lundi "," Mardi "," Mercredi "," Jeudi ",
		" vendredi "," samedi ");
		$mois =array(1=>" janvier "," février "," mars "," avril "," mai "," juin ",
		" juillet "," août "," septembre "," octobre "," novembre "," décembre ");
		?>
		
		<button class="new" data-skateholder-id = '<?=wp_get_current_user()->ID?>'>Nouveau</button>
		
		<div class = "newAppointement hide">
			<input class="newFormInputDay" type="date" name="day" value="<?= date('Y-m-d') ?>">
			<div class="newFormTimeChoose">
			</div>
			<select class="newFormSelectCustomer" name="customer" >
			<?php
				$allCustomers = get_users(['role' => 'customer']);
				foreach ($allCustomers as $currentCustomer){
					$meta = get_user_meta($currentCustomer->ID)?>
						<option value="<?=$currentCustomer -> ID?>">
								<?=$meta['first_name'][0] . ' ' . $meta['last_name'][0];?>
						</option>
				<?php
				}
				?>
		</select>
		<select class="newFormSelectDog" name="Dog" data-dogs='<?= $dogsInArrayOnJson;?>'>
		
		</select>
			<button class = "newFormSubmitButton">Créer</button>
		</div>	
		
		<p>Vos prochains rendez-vous :</p>
		
		<?php
			$no = 0;

		foreach ($mesRendevs as $currentRendev){
			$no +=1;
			if ($currentRendev->day < date("Y-m-d")){
				$old = true;
			}
			?>
			<div class="appointement">
				<div class="left">
			
					<h3 data-id="<?=$currentRendev->appointement_id?>">Rendez-vous</h3>
					<?php $readableDate = $semaine[date('w', strtotime($currentRendev->day))] ." ".date('j', strtotime($currentRendev->day))."". $mois[date('n', strtotime($currentRendev->day))]. date('Y', strtotime($currentRendev->day))?>
					<p class = "day <?=isset($old) ? "old" : ""?>" data-appointement-date='<?=$currentRendev->day?>'>
						<?=$readableDate?>
					</p>
					<input class="inputDay hide" type="date" name="day" value="<?= $currentRendev->day ?>">
					
					<p class = "time  <?=isset($old) ? "old" : "" ?>" data-current-time='<?=
			 		//* strtr transforms the ':' into 'h', and substr cuts the seconds (the 3 last characteres)
			 		strtr(substr($currentRendev->start_time, 0, -3),':', 'h');?>'>à :
					 	</span>
					<?=strtr(substr($currentRendev->start_time, 0, -3),':', 'h');?>
						</span>
					</p>
			<div class="timeChoose">
			</div>

			<p class="customer <?=isset($old) ? "old" : "" ?>">
				Avec :<span>
				<?php $customer = [
					'data' => get_userdata($currentRendev->customer_id), 'meta' => get_user_meta($currentRendev->customer_id)
					];
				echo $customer['meta']['first_name'][0] . ' ' . $customer['meta']['last_name'][0];?></span>
			</p>
			<select class="selectCustomer hide" name="customer" >
				<?php
				$allCustomers = get_users(['role' => 'customer']);
				foreach ($allCustomers as $currentCustomer){
					$meta = get_user_meta($currentCustomer->ID)?>
						<option value="<?=$currentCustomer -> ID?>" <?= $currentCustomer->ID == $currentRendev->customer_id ? "selected" : ""?>>
								<?=$meta['first_name'][0] . ' ' . $meta['last_name'][0];?>
						</option>
				<?php
				}
				?>
			</select>
			
			<p class="dog <?=isset($old) ? "old" : "" ?>">
			Pour son chien : <span><?= get_the_title($currentRendev->dog_id);?></span>
			</p>
			<select class="selectDog hide" name="Dog" data-displayed-dog='<?= get_the_title($currentRendev->dog_id);?>' data-dogs='<?= $dogsInArrayOnJson;?>'>
		
			</select>
			
			</div>
			<div class="right">
				<h3>Actions</h3>
					<div class="form">
						<button class="validate hide">Valider</button>
						<button class="cancel hide">Annuler</button>
						<button class="modify" <?= isset($old) ? 'disabled' : "" ?>>Modifier</button>
						<button class="delete">Supprimer</button>
						<p class="confirm hide">Confirmer ?</p>
						<div class="confirmButtons hide">
							<button class="confirm-yes">oui</button>
							<button class="confirm-no">non</button>
						</div>
					</div>
			</div>
			<div class="orphelin<?=$currentRendev->skatholer_id == 0 ? "" : " hide"?>">
				<h3>Rendez-vous</br>orphelin</h3>
				<button class="honorMe" data-rdv-id='<?=$currentRendev->appointement_id?>' data-user-id='<?=wp_get_current_user()->ID?>' >
					Honorer ce </br>
					rendez-vous ?
				</button>	
			</div>
		</div>
			<?php
			unset($old);
		}
		?>
			<script src="../wp-content/plugins/poils-o-pattes/class/CustomMenus/Calendar/app.js"></script>
			<script src="../wp-content/plugins/poils-o-pattes/class/CustomMenus/Calendar/allAppointements.js"></script>
			<script src="../wp-content/plugins/poils-o-pattes/class/CustomMenus/Calendar/oneAppointement.js"></script>
			<script src="../wp-content/plugins/poils-o-pattes/class/CustomMenus/Calendar/newAppointement.js"></script>
	<?php
	}
}