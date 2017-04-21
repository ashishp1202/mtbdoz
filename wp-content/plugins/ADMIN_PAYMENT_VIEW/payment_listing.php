<?php
/*
Plugin Name: PAYMENT_LISTING
Plugin URI: http://example.com
Description: Simple WordPress Contact Form Plugin
Version: 1.0
Author: Daman
Author URI: http://w3guy.com
*/

add_action("admin_menu", "createMyMenus");
function createMyMenus()
{
	add_menu_page("newplugin ", "PAYMENT_LISTING", 0, "newplugin", "fetch");
}

function fetch()
{?>	
	<div class="container"><h1> PAYMENT DETAILS HERE </h1> </div>
	
<?php		
global $wpdb;
	   echo '<table class="wp-list-table widefat fixed striped pages">';
          echo '<tr>';
         echo "<td style='color:#0073AA; font-weight:bold;'> CLIENT NAME</td>";
         echo "<td style='color:#0073AA; font-weight:bold;'> TRANSACTION ID</td>";
         echo "<td style='color:#0073AA; font-weight:bold;'> CLIENT EMAIL</td>";
         echo "<td style='color:#0073AA; font-weight:bold;'>TOUR DATE</td>";
         echo "<td style='color:#0073AA; font-weight:bold;'>TOUR NUMBER</td>";
         echo "<td style='color:#0073AA; font-weight:bold;'>STATUS</td>";
         echo "<td style='color:#0073AA; font-weight:bold;'>AMOUNT</td>";
         echo "<td style='color:#0073AA; font-weight:bold;'>PARTICIPANTS</td>";
       
         echo '</tr>';
         $sql1= $wpdb->get_results("SELECT * from payment order by id desc");
		foreach($sql1 as $row)
		{

			echo '<tr>';
			echo "<td> ". $row->name . "</td>";
			echo "<td>" .  $row->transaction_id . "</td>";
			echo "<td>" . $row->email . "</td>";
			echo "<td>" . $row->date . "</td>";
			echo "<td>" . $row->tour_number . "</td>";
			echo "<td>" . $row->status . "</td>";
			echo "<td>" . $row->amount . "</td>";
			echo "<td>" . $row->participants . "</td>";
			echo '</tr>';

		} 
		echo '</table>';

}?>