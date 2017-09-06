<?php
require('oddsChecker.class.php');
require('reuse/page_init.php');
require('simple_scraping_library/simple_html_dom.php');
$time = "";
$allBookmakers = array(    'PP'=>'Paddypower',
                                'LD'=>'Ladbrokes',
                                'WH'=>'Wiliamhill',
                                'CE'=>'Coral',
                                'B3'=>'Bet365',
                                'BY'=>'Boylesport'
                            );


$approvedBookmakers = array();


function MyFunction() {
  //echo $_GET['venue'];
  }

  function bestPrice() {
  //echo('best price');
  //echo $_GET['venue'];
  //echo $_GET['time'];
  $allBookmakers = array(    'PP'=>'Paddypower',
                                  'LD'=>'Ladbrokes',
                                  'WH'=>'Wiliamhill',
                                  'CE'=>'Coral',
                                  'B3'=>'Bet365',
                                  'BY'=>'Boylesport'
                              );


$venue = $_GET["venue"];
$time = $_GET["time"];
$races = array();
$DateTime = new DateTime($time);
$result = $DateTime->format('H:i');
print_r($result);
$races = array('venueName'=>$venue, 'time'=>$DateTime, 'country'=>'GB');
$scraperObj = new oddsChecker($allBookmakers);
$horses = $scraperObj->getRacePrices($races);

foreach( $horses as $horse ){
		print_r("Horse Name: ".$horse->name);
		echo "<br>";
		print_r("Best Price: ".$horse->bestPrice);
		echo "<br>";

		echo "Available from:<br>";
		foreach($horse->bestBookmakers as $bookmaker){
			print_r($bookmaker);
			echo "<br>";
		}

		echo "Prices:<br>";
		foreach( $horse->prices as $price ){
			print_r($price);
			echo " - ";
		}
		echo "<br><br>";

		echo "Each way:<br>";
		foreach( $horse->eachWay as $ew ){
			print_r($ew);
			echo " - ";
		}
		echo "<br><br>";

         echo "Each way place:<br>";
		foreach( $horse->eachWayPlace as $ewp ){
			print_r($ewp);
			echo " - ";
		}
		echo "<br><br>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css" type="text/css">
    <head>
        <title>Login</title>
    </head>
    <body>
     <?php
     require('reuse/login_template.php');
     ?>
     <?php if($_SESSION['username']){ ?>
    <div class="well">Scraping</div>
    <!--***********************************************code from off line  ****************************************************** -->





 <?php
 if(isset($_GET["func"]) && $_GET["func"] === "myFunction") {



    bestPrice();
 }
$url = 'https://www.oddschecker.com/horse-racing';
$html = str_get_html(file_get_contents($url));

// array of elements with race name and time
$elements = [];
// Find all links
foreach($html->find('div#mc section') as $element)
$elements [] = $element;


//find header tag and print
foreach($elements[0]->find('header') as $header)
  ?><div class="well"><?php echo $header; ?></div><?php



//array index 0 and 3 are from uk and irl
////foreach($elements[0]->find('.race-details') as $racing_time)
//echo '<div style="float: left; width: 200px;">'.$racing_time.'</div>';
//echo '<div style="clear:both;"></div>';

foreach($elements[0]->find('a') as $racing_time) {
    $temp = explode('/', $racing_time->href);
    $venuName = $temp[2];

    if (count($temp)==5){$time = $temp[3];}
    $racing_time->href = ("?func=myFunction&venue=$venuName&time=$time");
echo '<div style="float: left; width: 200px;">'.$racing_time.'</div>';

}



 ?>

    <!-- *************************************************end********************************************************************* -->
    <?php } ?>
    </body>
</html>
