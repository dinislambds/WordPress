<?php  

// loop

//While

// Foreach

// Foreach Switch case

// Link: https://docs.reduxframework.com/core/fields/sorter/
if(is_array($multiple)){
	foreach ($multiple as $single) {
		switch($single){
			case 'slider':
				get_template_part('slider');
				break;
			case 'service':
				get_template_part('service');
				break;
			}
		}
}
}


// foreach array theke value ber korar jonne use kora better

if(is_array($multiple)){
	foreach ($multiple as $single) {
	echo $singple;
}
}

// ekhon $singple er moddhe kono value na pele 'invalid argument' nam e akta warning dekhay. So, if diye use korle ar kono prblm nay


