<?php

namespace Poils_o_pattes\CustomMenus;

use Poils_o_pattes\Models\Services;

class MenuServices
{
    public function createMenu()
    {
        add_menu_page("Services", "Services", "edit_posts", "services", [self::class, 'content'], 'dashicons-block-default', 25);
    }

    public static function content()
    {
        ?>

        <h2>Bienvenue dans le gestionnaire de services !</h2>

        <div class="table-wrapper">
            <table class="fl-table">
                <div id="add-service">
                    <form action="" method="post" id="addForm" name="addForm">
                        <label for="sname">Nom</label>
                        <input type="text" id="sname" name="sname" value="<?= $_POST['nom_service'] ?? '' ?>" placeholder="Nom de service" size="10" required>

                        <label for="tservice">Type</label>
                        <select name="tservice" id="tservice" required>
                            <option value="">--Type service--</option>

                            <option value="toilettage">Toilettage</option>
                            <option value="spa">Spa</option>
                        </select>

                        <label for="pname">Petit prix:</label>
                        <input type="number" id="pname" name="prix_petit" class="champ-number" placeholder="0" required>

                        <label for="mname">Prix moyen:</label>
                        <input type="number" id="mname" name="prix_moyen" class="champ-number" placeholder="0" required>

                        <label for="gname">Grand prix:</label>
                        <input type="number" id="gname" name="prix_grand" class="champ-number" placeholder="0" required>

                        <input type="submit" name="ajouter" class="add" value="Ajouter">
                    </form>
                </div>
        </div>
        <hr>
        <thead>
            <tr>
                <th>id</th>
                <th>Type du service</th>
                <th>Nom du service</th>
                <th>Petit tarif en €</th>
                <th>Moyen tarif en €</th>
                <th>Grand tarif en €</th>
                <th>Gestion</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $services = new Services();
        $allServices = $services->findAll();

        foreach ($allServices as $curentService) :
          //var_dump($curentService)  ?>
                <tr>
                    <td><?=$curentService->service_id?></td>
                    <td><?=$curentService->type_service?></td>
                    <td><?=$curentService->nom_service?></td>
                    <td><?=$curentService->prix_petit?>€</td>
                    <td><?=$curentService->prix_moyen?>€</td>
                    <td><?=$curentService->prix_grand?>€</td>
                    <td>
                        <form action="" method="post" class="modform">
                            <input type="hidden" name="id" value="<?= $curentService->service_id ?>">
                            <input type="submit" name="supprimer" value="Supprimer">
                            <!-- <input type="submit" name="modifier" value="Modifier"> -->
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        <tbody>
            </table>
            </div>
            <?php
            //insert the service in the database

            if (isset($_POST['ajouter'])) {
								
								global $wpdb;
								
                $wpdb->insert(
                    'services',
                    array(
                        'nom_service' => $_POST['sname'],
                        'type_service'=> $_POST['tservice'],
                        'prix_petit'  => $_POST['prix_petit'],
                        'prix_moyen'  => $_POST['prix_moyen'],
                        'prix_grand'  => $_POST['prix_grand'],
                    )
                );
								
                if ($wpdb == true) {
                    //* refreshing page to display new service
                    echo '<script>location.reload();</script>';
                } else {
                    echo '<script> alert ("error!")</script>';
                }
            }
	    
            //update the service in the database
            // if (isset($_POST['modifier'])) {
            //     global $wpdb;
            //     //var_dump($_POST);
            //     //die;
            //     $wpdb->update(
            //         'services',
            //         array(
            //             'nom_service' => $_POST['sname'],
            //             'type_service' => $_POST['tservice'],
            //             'prix_petit' => $_POST['prix_petit'],
            //             'prix_moyen' => $_POST['prix_moyen'],
            //             'prix_grand' => $_POST['prix_grand'],
            //         ),
            //         array('service_id' => $_POST['service_id'])
            //     );
            //     if ($wpdb == true) {
                    //* refreshing page to display new service
            //        echo '<script>location.reload();</script>';
            //     } else {
            //         echo '<script> alert ("error!")</script>';
            //     }
            // }
	    
            //Delete Data from Database
            if (isset($_POST['supprimer'])) {
                global $wpdb;
                $wpdb->delete(
                    'services',
                    array('service_id' => $_POST['id'])
                );
                if ($wpdb == true) {
                    echo '<script>location.reload();</script>';
                } else {
                    echo '<script> alert ("error!")</script>';
                }
            }

        ?>

            <style>
                h2 {
                    text-align: center;
                    font-size: 18px;
                    /* text-transform: uppercase; */
                    color: rgb(48, 45, 45);
                    padding: 30px 0;
                }

                .table-wrapper {
                    margin: 10px 70px 70px 10px;
                    box-shadow: 0px 50px 80px rgba(0, 0, 0, 0.1);
                }

                .fl-table {
                    border-radius: 5px;
                    font-size: 12px;
                    font-weight: normal;
                    border: none;
                    border-collapse: collapse;
                    width: 100%;
                    white-space: nowrap;
                    background-color: white;
                }

                .fl-table td,
                .fl-table th {
                    text-align: center;
                    padding: 8px;

                }

                .fl-table td {
                    border-right: 1px solid #f8f8f8;
                    font-size: 12px;
                }

                .fl-table thead th {
                    color: #ffffff;
                    background: #78a899;

                }

                .fl-table thead th:nth-child(odd) {
                    color: #ffffff;
                    background: #8d9ba8;
                }

                .fl-table tr:nth-child(even) {
                    background: #F8F8F8;
                }

                button {
                    color: blueviolet;
                    border: none;
                    background: #ccc;
                    border-radius: 2px;
                    transition: 0.5s;
                }

                input {
                    color: blueviolet;
                    border: none;
                    background: #ccc;
                    font-size: 1.1em;
                    border-radius: 5px;
                    transition: 0.5s;
                    cursor: pointer;
                }

                input[type=number] {
                    width: 70px;
                }

                #modif-service,
                #add-service {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 5px;
                }

                @media (max-width: 980px) {


                    .fl-table {
                        overflow-x: scroll;
                        width: 100%;

                    }

                    #add-service,
                    #modif-service {
                        display: flex;
                        flex-direction: column;
                        flex-wrap: wrap;
                        justify-content: space-evenly;
                        align-items: center;
                        align-content: center;
                    }

                    #wpbody-content {
                        overflow: scroll;
                        align-items: center;
                    }

                    .fl-table td,
                    .fl-table th {
                        text-align: center;
                        padding: 5px 0px 5px 0;
                    }

                    input {
                        color: blueviolet;
                        padding: 8px 30px;
                        border: none;
                        background: #ccc;
                        font-size: 1.1em;
                        border-radius: 5px;
                        transition: 0.5s;
                        cursor: pointer;
                    }

                    p {
                        text-align: center;

                    }
                }
            </style>
        <?php
    }
}
