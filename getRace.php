<?php
require('oddsChecker.class.php');
require('reuse/page_init.php');
require('simple_scraping_library/simple_html_dom.php');
require('reuse/page_init.php');



$venue = $_GET["venue"];  // get venue from url
$time = "";
$bestpricescrape = array(); // to hold all prices from the scraper
$bestpricescrape2 = array(); // to hold all prices from the scraper
$bestpricescrape3 = array(); // to hold all prices from the scraper
$sortedArray = array();
$eachwaypricescrape = array();  //  to hold all each way prices
$table = array(); // array for displaying results make into 2d array later
$row2 = array(); // array for weighted price to be displayed in final table
$row3 = array(); // array for weighted price to be displayed in final table
$row4 = array(); // array for edge1 to be displayed in final table
$row5 = array(); // array for edge2 to be displayed in final table
$row6 = array(); // array for lovwst lay price to be displayed in final table
$row7 = array(); // array for  ew edge1 to be displayed in final table
$row8 = array(); // array for ew edge2 to be displayed in final table
$row9 = array(); // weighted price
$row0 = array();// array of horses to display
$summary = array();  //array
$summaryWinMethod1 = array();  //dictionary to hold summary table
$summaryHorses = array();  //array to hold Horses
$summaryBf = array();  //dictionary to hold BF
$summaryEw1= array();  //Array to hold Ew method 1
$summaryEw2= array();  //Array to hold Ew method 2
$summaryBookies = array();  //dictionary to hold bookies
$summaryBookie = array();  //dictionary to hold bookies
$summaryWin1= array();  //Array to hold Win method 1
$summaryWin2= array();  //Array to hold Win method 2
$bestbookies = array(); // 2d array to hold best bookies
$bestbookie = array(); // 1d array to hold best bookies
$i = 0;
$j = 0;
//*************************************************************************START SCRAPING***************************************************************
function bestPrice() {  //function to get scraping results
global $bestbookies; //2d array to hold best bookies
global $bestbookie;  //1d array to hold best bookies
$venue = $_GET["venue"];
//print_r($venue);
$time = $_GET["time"];
}
global $bestpricescrape;
$allBookmakers = array(         'PP'=>'Paddypower',         // array to check against
                                'LD'=>'Ladbrokes',
                                'WH'=>'Wiliamhill',
                                'CE'=>'Coral',
                                'B3'=>'Bet365',
                                'BY'=>'Boylesport',
                                'SK'=> 'Skybet',
                                'RD'=>'32red',
                                'FR'=>'betfred',
                                'SO'=>'sportingbet',
                                'VC'=>'betvector',
                                'UN'=>'unibet',
                                'BX'=>'Totesport',
                                'BR'=>'BetRight',
                                'SJ'=>'stanjames',
                                'WA'=>'betway',
                                'EB'=>'188bet',
                                'EE'=>'888sport',
                                'WN'=>'winner',
                                'MR'=>'marathonbet',
                                'OE'=>'10bet',
                                'BR'=>'BetRight',
                                'P3'=>'sunbet',
                                'BL'=>'blacktype',
                                'BB'=>'betright',
                                'FB'=>'betfairsportsbook',
                                'PS'=>'betstars'


                            );
                            // Store the selected bookmakers in the $approvedBookmakers array

                          //  echo "<h3>approvedBookmakers Array output:</h3>";

                            $selected = $_GET["bookmaker"];

                            foreach($selected as $bookmakerKey){

                                $approvedBookmakers[$bookmakerKey] = $allBookmakers[$bookmakerKey];

                              }




$venue = $_GET["venue"];  // get venue from url
$time = $_GET["time"];    //get time from url
$races = array();
$DateTime = new DateTime($time);
$result = $DateTime->format('H:i');
//print_r($result);
$races = array('venueName'=>$venue, 'time'=>$DateTime, 'country'=>'GB');
$scraperObj = new oddsChecker($approvedBookmakers);  // send to oddschecker class with bookie array as paramater
$horses = $scraperObj->getRacePrices($races);

// killing print statements as no longer required
foreach( $horses as $horse ){
//  print_r("Horse Name: ".$horse->name);
  //echo "<br>";
$bestpricescrape[] = $horse->bestPrice;
 // print_r("Best Price: ".$horse->bestPrice);
 // echo "<br>";

  //echo "Available from:<br>";
  $bestbookie = array();
  foreach($horse->bestBookmakers as $bookmaker){
    $bestbookie[] = $bookmaker;
   // print_r($bookmaker);
   //echo "<br>";
 }

 //arrprint_r(key($bestbookie));
 // $bestbookies[] = $bestbookie;
  //echo "Prices:<br>";
 //foreach( $horse->prices as $price ){
  //  print_r($price);
   // echo " - ";
  //}
  //echo "<br><br>";

 // echo "Each way:<br>";
  foreach( $horse->eachWay as $ew ){
    $eachwaypricescrape[] = $ew;
   // print_r($ew);
   // echo " - ";
  }
 // echo "<br><br>";

   //    echo "Each way place:<br>";
//  foreach( $horse->eachWayPlace as $ewp ){
 //   print_r($ewp);
 //   echo " - ";
//  }
 // echo "<br><br>";
}

//*************************************************************************END SCRAPING***************************************************************


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="checklist_model.js"></script>
    <head>
        <title>one time</title>
       <meta http-equiv="refresh" content="8" >  
        <style>
        .left{
          width:100px;
          float:left;
          color:blue;
        }
        .left-horse{
          width:200px;
          float:left;
          color:blue;
          
        }
         .bookie{
          width:220px;
          float:left;
          color:blue;
          margin-right: 20px;
          overflow: auto;
          overflow-y: hidden;
        }
        </style>

<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        window.location.reload();
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1500);
</script>
    </head>
    <body>
     <?php
     require('reuse/login_template.php');
     ?>
     <?php if($_SESSION['username']){ ?>
    <div class="well">API</div>
     <?php } ?>
<?php
 if(isset($_GET["func"]) && $_GET["func"] === "myFunction") {  // if url has myFunction



    bestPrice(); // call function to do scraping
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

  ?>

    <script>
    angular.module('check', ['checklist-model'])
         .controller('controller', function($scope) {
                    $scope.bookmakerList = [
                {key: 'PP', name: 'Paddypower'},
                {key: 'LD', name: 'Ladbrokes'},
                {key: 'WH', name: 'Wiliamhill'},
                {key: 'CE', name: 'Coral'},
                {key: 'B3', name: 'Bet365'},
                {key: 'BY', name: 'Boylesport'},
                {key: 'SK', name: 'Skybet'},
                {key: 'RD', name: '32red'},
                {key: 'FR', name: 'betfred'},
                {key: 'VC', name: 'betvector'},
                {key: 'UN', name: 'unibet'},
                {key: 'BX', name: 'Totesport'},
                {key: 'BR', name: 'BetRight'},
                {key: 'SJ', name: 'stanjames'},
                {key: 'WA', name: 'betway'},
                {key: 'EB', name: '188bet'},
                {key: 'WN', name: 'winner'},
                {key: 'MR', name: 'marathonbet'},
                {key: 'OE', name: '10bet'},
                {key: 'BR', name: 'BetRight'},
                {key: 'P3', name: 'sunbet'},
                {key: 'BL', name: 'blacktype'},
                {key: 'BB', name: 'betright'},
                {key: 'FB', name: 'betfairsportsbook'},
                {key: 'PS', name: 'betstars'},
            
                
              ];
            $scope.selected = {
                bookmakers: []
            };

             $scope.checkAll = function() {
                 $scope.selected.bookmakers = angular.copy($scope.bookmakerList);
              };
              $scope.uncheckAll = function() {
                  $scope.selected.bookmakers = [];
              };
        });
      </script>
      <div ng-app="check">
          <div ng-controller="controller">
              <label ng-repeat="bookmaker in bookmakerList">
              <input type="checkbox" checklist-model="selected.bookmakers" checklist-value="bookmaker"/> {{bookmaker.name}}</label><br>
               <button ng-click="checkAll()">Check all</button>
              <button ng-click="uncheckAll()">Uncheck all</button> <br/>
    <?php

    // get venue and race times
    $lastVenue = "";
    foreach($elements[0]->find('a') as $racing_time) {
        $temp = explode('/', $racing_time->href);
        $venueName = $temp[2];
        if (count($temp)==5){
          $time = $temp[3];
          if ($venueName != $lastVenue){
            if ($lastVenue == ""){
              echo "<div class='racetimes'>";
            } else {
              echo "</form>";
              echo "</div>";
              echo "<div class='racetimes'>";
            }
            echo "<form method='get' action='getRace.php'>";
            // include the bookmakers
            ?>
            <label ng-repeat="bookmaker in selected.bookmakers">
              <input type="hidden" name="bookmaker[]" value='{{bookmaker.key}}'>
            </label>
            <?php
            $lastVenue = $venueName;
            echo "<h3>";
            echo ucfirst($venueName);
            echo "</h3>";
            echo "<input type='hidden' name='venue' value='$venueName'>";
            //echo "<br>";
          }
          echo "<input type='submit' name='time' value='$time'>";
          //echo "<br>";
      }
    }
    echo "</div>";

    ?>
    </div>
    </div>
    </form>
    </body>
    </html>

<?php require 'reuse/login_betfair.php'; ?> <!--add code to login to betfair api and obtain session
<!--**************************************************************START api section *****************************************************************-->

<?php
	 //interacting with API
	// Supply BF_BF_APP_KEY and BF_BF_SESSION_TOKEN HERE
	// ***NB***KEEP SECURE! DON'T MAKE AVAILABLE WITH APP_KEY OR SESSION_TOKEN INCLUDED

	$BF_APP_KEY = 'CmTri7cNHcaCaBc9';
	$BF_SESSION_TOKEN = $sessionToken;

	$DEBUG = False;  // Set to false for production

	// get all event types
	$allEventTypes = getAllEventTypes($BF_APP_KEY, $BF_SESSION_TOKEN);

	// Extract Event Type Id for Horse Racing
	$horseRacingEventTypeId = extractHorseRacingEventTypeId($allEventTypes);


	$getAllCountries =getAllCountries($BF_APP_KEY, $BF_SESSION_TOKEN, $horseRacingEventTypeId);



	// Get next horse racing market in the UK.

	$win = "WIN"; //string to send to getNextUkHorseRacingMarket
 
	$nextHorseRacingMarket = getNextUkHorseRacingMarket($BF_APP_KEY, $BF_SESSION_TOKEN, $horseRacingEventTypeId, $win);

    //print_r($nextHorseRacingMarket);
    echo "<br><br><br>";
  //  print_r($nextHorseRacingMarket->runners);
    $runnersArray = $nextHorseRacingMarket->runners; //array with runners from api
    
  //  echo $temp[0]->runnerName;
	$venueDateTime =  $nextHorseRacingMarket->event->openDate;
        $venuName = $nextHorseRacingMarket->event->venue;
	$totalMatched = $nextHorseRacingMarket->totalMatched;
	 $totalMatched = number_format((float)$totalMatched, 0, '.', '');
	//print_r($totalMatched);



	 	// Get volatile info for Market including best 3 exchange prices available.
	$marketBook = getMarketBook($BF_APP_KEY, $BF_SESSION_TOKEN, $nextHorseRacingMarket->marketId);
	//print_r("<br><br>");
	//	print_r("***************************************************************************  START WIN  *******************");
	//	print_r("<br><br>");
	// Print volatile price data along with static runner info.
	printMarketIdRunnersAndPrices($nextHorseRacingMarket, $marketBook);
	//print_r("<br><br>");
		//print_r("***************************************************************************  END   WIN   *******************");
		//print_r("<br><br>");

		// Get next horse racing market in the UK.
		//print_r("***************************************************************************  START   PLACE   *******************");
		$place = "PLACE";
	$nextHorseRacingMarket = getNextUkHorseRacingMarket($BF_APP_KEY, $BF_SESSION_TOKEN, $horseRacingEventTypeId, $place);


		// echo "</br>";
	// Get volatile info for Market including best 3 exchange prices available.
	$marketBook = getMarketBook($BF_APP_KEY, $BF_SESSION_TOKEN, $nextHorseRacingMarket->marketId);

	// Print volatile price data along with static runner info.
	printMarketIdRunnersAndPrices2($nextHorseRacingMarket, $marketBook);
	//	print_r("***************************************************************************  END   PLACE   *******************");

 $num = count($bestbookies);  // number of best bookies
 
//**************************START OF 2 TABLES TO DISPLAY FINAL RESULTS**********************************************************************
//**************************disply loops for Method 1**********************************
echo"<div>";
print_r("<h2>Method 1 Total Matched is $totalMatched. Venue: $venuName Date/Time: $venueDateTime</h2> <p>Refresh <small>roughly</small> in <span id='counter'>8</span> second(s).</p>");

//************************Horses from scraping after being sorted*************************************
print_r("<div class='left-horse'>");
echo "<h4>Horse scrape (odds)</h4>";
foreach( $sortedArray as $horse ){
 print_r($horse->name);
 $summaryHorses[] = $horse->name; // add horse name from sorted array to summaryHorses
  echo "<br>";
}
echo"</div>";
//***********************best bookie from sorted bestbookie array**************************************
print_r("<div class='bookie'>");
echo "<h4>Book</h4>";
for ($row = 0; $row < $num; $row++) {
//echo "<p><b>Row number $row</b></p>";
//echo "<ul>";
for ($col = 0; $col < (count($bestbookies[$row])); $col++) {
echo array_search($bestbookies[$row][$col], $allBookmakers).",";
$summaryBookie[] = array_search($bestbookies[$row][$col], $allBookmakers);
}
  echo "<br>";
  $summaryBookies[] = $summaryBookie;
}
echo"</div>";
//*************************************************************
print_r("<div class='left-horse'>");
echo "<h4>Horse API</h4>";
foreach ($runnersArray as $key => $object) {
    echo $object->runnerName;
echo "<br>";
}
echo"</div>";
//*************************************************************
print_r("<div class='left'>");
echo "<h4>BF</h4>";
foreach($row2 as $values)
{
echo "$values";
$summaryBf[] = $values; // add BF to array

echo "<br>";
}


echo"</div>";
//*************************************************************
print_r("<div class='left'>");
echo "<h4>L</h4>";
foreach($row6 as $values)
{
echo "$values";
echo "<br>";
}
echo"</div>";
//*************************************************************
print_r("<div class='left'>");
echo "<h4>BP</h4>";
foreach($row3 as $values)
{
echo "$values";
echo "<br>";
}
echo"</div>";
//*************************************************************
print_r("<div class='left'>");
echo "<h4>Win</h4>";
foreach($row4 as $values)
{
echo "$values";
$summaryWin1[] = $values;
echo "<br>";
}
echo"</div>";


//************************************************************
/*echo"<div style='float:left;'>";
$length = count($row4);
echo "<h4>new ew edge 1</h4>";
for ($i = 0; $i < $length; $i++) {
  print_r("($row4[$i]+$row7[$i])/2");
  echo "<br>";
}
echo"</div>";*/
echo"<div style='float:left;'>";
$length = count($row4);
echo "<h4>EW</h4>";
for ($i = 0; $i < $length; $i++) {
  echo ($row4[$i]+$row7[$i])/2;
 $summaryEw1[] = ($row4[$i]+$row7[$i])/2;
  echo "<br>";
}

echo"</div>";
echo"</div>";

//**************************disply loops for Method 2**********************************
echo"<div style='float:left;clear: both;'>";
print_r("<h2>Method 2</h2>");
print_r("<div class='left-horse'>");
echo "<h4>Horse</h4>";
foreach($row0 as $values)
{
echo "$values";
echo "<br>";
}
echo"</div>";
print_r("<div class='left'>");
echo "<h4>BF</h4>";
foreach($row9 as $values)
{
echo "$values";
echo "<br>";
}
echo"</div>";
print_r("<div class='bookie'>");
echo "<h4>Book</h4>";
for ($row = 0; $row < $num; $row++) {
//echo "<p><b>Row number $row</b></p>";
//echo "<ul>";
for ($col = 0; $col < (count($bestbookies[$row])); $col++) {
echo array_search($bestbookies[$row][$col], $allBookmakers).",";
}
  echo "<br>";
}


echo"</div>";
print_r("<div class='left'>");
echo "<h4>L</h4>";
foreach($row6 as $values)
{
echo "$values";
echo "<br>";
}
echo"</div>";
print_r("<div class='left'>");
echo "<h4>BP</h4>";
foreach($row3 as $values)
{
echo "$values";
echo "<br>";
}
echo"</div>";
print_r("<div class='left'>");
echo "<h4>Win</h4>";
foreach($row5 as $values)
{
$summaryWin2[] = $values;
echo "$values";
echo "<br>";
}
echo"</div>";
/*print_r("<div class='left'>");
echo "<h4>EW edge 1</h4>";
foreach($row7 as $values)
{
echo "$values";
echo "<br>";
}
echo"</div>";
print_r("<div class='left'>");
echo "<h4>EW Edge 2</h4>";
foreach($row8 as $values)
{
echo "$values";
echo "<br>";
}
echo"</div>";*/
/*echo"<div style='float:left;'>";
$length = count($row4);
echo "<h4>new ew edge 1</h4>";
for ($i = 0; $i < $length; $i++) {
  print_r("($row5[$i]+$row8[$i])/2");
  echo "<br>";
}
echo"</div>"; */
echo"<div style='float:left;'>";
$length = count($row4);
echo "<h4>EW</h4>";
for ($i = 0; $i < $length; $i++) {
  $summaryEw2[] = ($row5[$i]+$row8[$i])/2;
    echo($row5[$i]+$row8[$i])/2;
  echo "<br>";
}
echo"</div>";


echo"</div>";
//**************************END OF 2 TABLES TO DISPLAY FINAL RESULTS**********************************************************************
//*********************************  START OF SUMMARY TABLE**********************************************************************
echo"<div style='float:left;'>";
echo"inside summary";
function summary($h, $b, $w1,$ew1,$w2,$ew2){
  return(array('horse'=>$h,'bookies'=>$b, 'edge1'=>max($w1, $ew1), 'edge2'=>max($w2, $ew2),));
}

//$horses = array("horse1" => "bobby", "horse2" => "frank", "jack");
//$win_edges = array(1, 2, 7);
//$ew_edges = array(5, 1, 3);

$summary = array_map("summary", $summaryHorses,$summaryBookies, $summaryWin1, $summaryEw1, $summaryWin2, $summaryEw2 );
//print_r($summary);
echo"<br>";
//echo"summary array";


//$race_details = array(); // the one with all the details in it (I haven’t been able to find where you have this yet
$edges = array();  // to hold just the edges to help with sorting
//the edges will need to be a single value (already calculated by getting the max of WIN and edge)
//echo '<br>';
foreach ($summary as $key => $row)
{
  $edges[$key] = $row['edge1'];
}
// Now sort the $race_details array ready for display in the summary
array_multisort($edges, SORT_DESC, $summary);

print_r($summary);
echo"</div>";

echo"<div style='float:left;'>";
print_r("<div class='bookie'>");
echo "<h4>Name</h4>";
foreach($summary as $key => $value)
{
echo $value['horse'];
echo "<br>";
}
echo"</div>";
print_r("<div class='bookie'>");
echo "<h4>Bookie</h4>";
foreach($summary as $key => $value)
{
  foreach($value['bookies'] as $bookie)
  {
    echo $bookie;
  }
echo "<br>";
}
echo"</div>";
print_r("<div class='left'>");
echo "<h4>Method 1</h4>";
foreach($summary as $key => $value)
{
echo $value['edge1'];
echo "<br>";
}
echo"</div>";
print_r("<div class='left'>");
echo "<h4>Method 2</h4>";
foreach($summary as $key => $value)
{
echo $value['edge2'];
echo "<br>";
}
echo"</div>";
echo"</div>";echo"</div>";
echo"<div style='width:1000px; float:left;'>";
echo "<br><br><br><br><br>";
echo "END";
echo"</div>";
//*********************************** END OF SUMMARY TABLE**********************************************************************



	function getAllEventTypes($appKey, $sessionToken)
	{
		$jsonResponse = sportsApingRequest($appKey, $sessionToken, 'listEventTypes', '{"filter":{}}');
		return $jsonResponse;
	}

	function extractHorseRacingEventTypeId($allEventTypes)
	{
		foreach ($allEventTypes as $eventType) {
			if ($eventType->eventType->name == 'Horse Racing') {
				return $eventType->eventType->id;
			}
		}
	}


function getNextUkHorseRacingMarket($appKey, $sessionToken, $horseRacingEventTypeId, $win)

{  //$venue = "Chelmsford City";

$tracks = array(
			 'Aintree',
			 'Ascot',
			 'Ayr',
			 'Ballinrobe',
			 'Bangor',
			 'Bath',
			 'Bellewstown',
			 'Beverley',
			 'Brighton',
			 'Carlisle',
			 'Cartmel',
			 'Catterick',
			 'Cheltenham',
			 'Chepstow',
			 'Chester',
			 'Clonmel',
			 'Cork',
			 'Doncaster',
			 'Down Royal',
			 'Downpatrick',
			 'Dundalk',
			 'Epsom',
			 'Exeter',
			 'Fairyhouse',
			 'Fakenham',
			 'Folkstone',
			 'Ffos Las',
			 'Fontwell',
			 'Galway',
			 'Goodwood',
			 'Gowran Park',
			 'Hamilton',
			 'Haydock',
			 'Hereford',
			 'Hexham',
			 'Huntingdon',
			 'Kelso',
			 'Kempton',
			 'Kilbeggan',
			 'Killarney',
			 'Layton',
			 'Leicester',
			 'Leopardstown',
			 'Limerick',
			 'Lingfield',
			 'Listowel',
			 'Ludlow',
			 'Market Rasen',
			 'Musselburgh',
			 'Naas',
			 'Navan',
			 'Newbury',
			 'Newcastle',
			 'Newmarket',
			 'Newton Abbot',
			 'Nottingham',
			 'Perth',
			 'Plumpton',
			 'Pontefract',
			 'Punchestown',
			 'Redcar',
			 'Ripon',
			 'Roscommon',
			 'Salisbury',
			 'Sandown',
			 'Sedgefield',
			 'Sligo',
			 'Southwell',
			 'Stratford',
			 'Taunton',
			 'The Curragh',
			 'Thirsk',
			 'Thurles',
			 'Tipperary',
			 'Towcester',
			 'Tralee',
			 'Tramore',
			 'Uttoxeter',
			 'Warwick',
			 'Wetherby',
			 'Wexford',
			 'Wincanton',
			 'Windsor',
			 'Wolverhampton',
			 'Worcester',
			 'Yarmouth',
			 'York',
			'Great Leighs'
		);

$venue2 = $_GET["venue"];
if (strpos($venue2, '-')){
	$venue2 = str_replace('-', ' ', $venue2);
}
      $venueFromArray = "";


      foreach($tracks as $a) {
        if (stripos($venue2,$a) !== false){
          $venueFromArray = $a;
    }

   }
  // print_r($venueFromArray);
   // need to add one hour to time.
   $time = ($_GET["time"]);
   $timestamp = strtotime($time) - 60*60;

$timePlus = date('H:i', $timestamp);

//   print_r($timePlus);
  $marketStartTime = '{"from":"'.date("Y-m-d").'T'.$timePlus.':00Z"}';
//print_r($marketStartTime);

    $params = '{"filter":{"eventTypeIds":["' . $horseRacingEventTypeId . '"],
	          "venues":["' .$venueFromArray.'"],
              "marketTypeCodes":["'.$win.'"],
              "marketStartTime":'.$marketStartTime.'},
              "sort":"FIRST_TO_START",
              "maxResults":"1",
               "marketProjection": [
                "MARKET_START_TIME",
                "RUNNER_METADATA",
                "RUNNER_DESCRIPTION",
                "EVENT_TYPE",
                "EVENT",
                "COMPETITION"
            ]}';
    $jsonResponse = sportsApingRequest($appKey, $sessionToken, 'listMarketCatalogue', $params);
    return $jsonResponse[0];
}





    function  getAllCountries($appKey, $sessionToken, $horseRacingEventTypeId)
	{
			$params = '{"filter":{"marketIds": ["1"]}
				  }';
		$jsonResponse = sportsApingRequest($appKey, $sessionToken,'listCountries', $params);

		return $jsonResponse;

	}

	function printMarketIdAndRunners($nextHorseRacingMarket)
	{
		//echo "MarketId: " . $nextHorseRacingMarket->marketId . "</br>";
		//echo "MarketName: " . $nextHorseRacingMarket->marketName . "</br>";
		foreach ($nextHorseRacingMarket->runners as $runner) {
			//echo "SelectionId: " . $runner->selectionId . " RunnerName: " . $runner->runnerName . "</br>";
		}
	}

	function getMarketBook($appKey, $sessionToken, $marketId)
	{
		$params = '{"marketIds":["' . $marketId . '"], "priceProjection":{"priceData":["EX_BEST_OFFERS"]}}';
		$jsonResponse = sportsApingRequest($appKey, $sessionToken, 'listMarketBook', $params);
		return $jsonResponse[0];
	}
// this is the main function to calculate all required amounts. had to duplicate this
// for place bets and the only differnace was send the string place instead of the string  win
	function printMarketIdRunnersAndPrices($nextHorseRacingMarket, $marketBook)
	{
    global $horses; // array of horses from scraper
		$lowestLay = array();  // array for the 3 lowest lay prices
		$highestBack = array(); // array for the 3 highest back prices
    global $row0;
    global $bestpricescrape3;  //array from scraper for best price
    global $bestbookies;
    global $sortedArray;

		function printAvailablePrices($selectionId, $marketBook)

		{
      $lowestLayPrice;
      $lowestLayAmount;
      $highestBackPrice;
      $highestBackAmount;
      $weightedPrice;
      global $bestpricescrape;  //array from scraper for best price
      global $bestpricescrape3;  //array from scraper for best price
      $bestpricerunner;  // to hold each horse from the above array
      global $i;
      global $eachwaypricescrape;  // array from scraper for each way odds
      global $row2;
      global $row3;
      global $row4;
      global $row5;
      global $row6;
      global $row9; // weighted price
      $eachwaypricescrapesingle;
      $eachwaypricescrapesingle = convertToDecimal($eachwaypricescrape[0]);


      // Get selection
      foreach ($marketBook->runners as $runner)
        if ($runner->selectionId == $selectionId) break;
    //  echo "\nAvailable to Back:    ";

      foreach ($runner->ex->availableToBack as $availableToBack){
      //  echo $availableToBack->size . "@" . $availableToBack->price . " | ";
        $highestBack[]  = $availableToBack->price;      // add price to array
      }
    //  echo "<br> Available to Lay:   ";

      foreach ($runner->ex->availableToLay as $availableToLay){
       // echo $availableToLay->size . "@" . $availableToLay->price . " | ";
        $lowestLay[] = $availableToLay->price;	 // add price to array
      }
//echo "<br>";
    //get element 0 from array and calculate edge
    foreach ($runner->ex->availableToLay as $availableToLay){
    $lowestLayPrice = $availableToLay->price;
    $lowestLayAmount = $availableToLay->size;
    break;} //break so that only element 0 is passed

    foreach ($runner->ex->availableToBack as $availableToBack){
    $highestBackPrice = $availableToBack->price;
    $highestBackAmount = $availableToBack->size;
    break;}//break so that only element 0 is passed

    if(isset($lowestLayPrice,$lowestLayAmount,$highestBackPrice,$highestBackPrice)) { // check this code to see if working
  //  print_r("<br> lowest lay price: " .$lowestLayPrice. "<br>");
    $row2[] = $lowestLayPrice;
  //  print_r("lowest lay amount: " .$lowestLayAmount. "<br>");
    $row6[] = $lowestLayAmount;
  //  print_r("highest Back lay amount: " .$highestBackAmount. "<br>");
  //  print_r("highest Back lay price: " .$highestBackPrice. "<br>");


    $weightedPrice = $highestBackPrice+(($highestBackAmount/($highestBackAmount+$lowestLayAmount))*($lowestLayPrice-$highestBackPrice));
   // print_r("weighted price that goes into BF method 2 is: ((".$highestBackAmount."/(".$highestBackAmount."+".$lowestLayAmount."))*(".$lowestLayPrice."-"
    //.$highestBackPrice.")) which is: ".number_format((float)$weightedPrice, 2, '.', ''). "<br>");
    $row9[] = number_format((float)$weightedPrice, 2, '.', '');
    //print_r($bestpricescrape);




    //  print_r("<br> each way from oddschecker: " .$eachwaypricescrapesingle."<br>");
      $bestpricerunner = $bestpricescrape3[$i];
    //  echo "\n best price from oddschecker: " .$bestpricescrape[$i]. "<br>";
      $row3[] = $bestpricescrape3[$i];
      $i++;


    //  print_r("Place price is oddschecker best price - 1(".$bestpricerunner."- 1".") is:  " .($bestpricerunner -1). " divided by each way terms +1(".$eachwaypricescrapesingle."- 1".") is:  "
    //   .($eachwaypricescrapesingle +1)." gives you ". (($bestpricerunner-1)*($eachwaypricescrapesingle)+1). " <br>");


      // print_r("win edge method 1 is odds checker best price: ".$bestpricerunner." divided by lowest lay amount (".$lowestLayPrice.") minus
       // 1:  ".(($bestpricerunner/$lowestLayPrice)-1).  "  or   ".number_format(((float)(($bestpricerunner/$lowestLayPrice)-1) * 100 ), 2, '.', '')."%<br>");
        $row4[] = number_format(((float)(($bestpricerunner/$lowestLayPrice)-1) * 100 ), 2, '.', '');

    //   print_r("win edge method 2 is odds checker best price: ".$bestpricerunner." divided by weighted price (".$weightedPrice.") minus 1: "
    //   .(($bestpricerunner/$weightedPrice)-1).  "  or   ".number_format(((float)(($bestpricerunner/$weightedPrice)-1) * 100 ), 2, '.', '')."%<br>");
       $row5[] = number_format(((float)(($bestpricerunner/$weightedPrice)-1) * 100 ), 2, '.', '');


    }//end if
		}
; //function printAvailablePrices
		//echo "MarketId: " . $nextHorseRacingMarket->marketId . "</br>";
		//echo "MarketName: " . $nextHorseRacingMarket->marketName. "</br>";
    // need to check here if horse matches scraper
    $counter = 0;
   
  /*  some testing loops
    echo "<h4>horses from odds checker</h4>";
     foreach ($horses as $name){
       echo $name->name;
       echo "<br>";
     }
     echo "<br>";
     echo "<h4>horses from betfair</h4>";
     foreach ($nextHorseRacingMarket->runners as $runner) {
       	echo $runner->runnerName;
         echo "<br>";}
         echo "<br>";
      */
   
     echo "<br>";
    // sorting horses needs to be checked
     foreach ($nextHorseRacingMarket->runners as $runner) {
        if ($horses[$counter]->name == $runner->runnerName){
       	 $sortedArray[] = $horses[$counter];
           $counter = $counter +1;
        }
        else{ 
          foreach ($horses as $name){
             if ($name->name == $runner->runnerName){
            $sortedArray[] = $name;
            $counter = $counter +1;}
          }
        }
     }  
         /*  some testing loops    
         echo "<br>";
         echo "<h4>horses sorted</h4>";
           foreach ($sortedArray as $newName){
       echo $newName->name;
        echo "<br>";}
        */

      foreach( $sortedArray as $horse ){
$bestpricescrape3[] = $horse->bestPrice; // redefine the best price  redefine all again
  
 /*  some testing loops
echo "best price of sorted array";
  print_r($bestpricescrape3);
  echo "<br>";
*/
  //echo "Available from:<br>";
  $bestbookie = array();
  foreach($horse->bestBookmakers as $bookmaker){
    $bestbookie[] = $bookmaker;
   // print_r($bookmaker);
   //echo "<br>";
 }

 //arrprint_r(key($bestbookie));
  $bestbookies[] = $bestbookie;
      }
  
		foreach ($nextHorseRacingMarket->runners as $runner) {
			//echo "</br>==============================================================================\n";
			//echo "SelectionId: " . $runner->selectionId . " RunnerName: " . $runner->runnerName . "</br>";
      $row0[] = $runner->runnerName;
			echo printAvailablePrices($runner->selectionId, $marketBook);  // call function to print
     
		}

	}

//***************************************************************duplicate*****************************************************************************
function printMarketIdRunnersAndPrices2($nextHorseRacingMarket, $marketBook)  //same as above without place price abd change call printAvailablePrices2
{
  $lowestLay = array();  // array for the 3 lowest lay prices
  $highestBack = array(); // array for the 3 highest back prices
  global $bestpricescrape2;
  global $horses;

  function printAvailablePrices2($selectionId, $marketBook)

  {
    $lowestLayPrice;
    $lowestLayAmount;
    $highestBackPrice;
    $highestBackAmount;
    $weightedPrice;
    global $row7; // array for ew edge 1
    global $row8;  // array for ew edge 2
    global $bestpricescrape2;  //array from scraper for best price
    $bestpricerunner;  // to hold each horse from the above array
    global $j;
    global $eachwaypricescrape;  // array from scraper for each way odds
    $eachwaypricescrapesingle;
    $eachwaypricescrapesingle = convertToDecimal($eachwaypricescrape[0]);


    // Get selection
    foreach ($marketBook->runners as $runner)
      if ($runner->selectionId == $selectionId) break;
//    echo "\nAvailable to Back:    ";

    foreach ($runner->ex->availableToBack as $availableToBack){
  //    echo $availableToBack->size . "@" . $availableToBack->price . " | ";
      $highestBack[]  = $availableToBack->price;      // add price to array
    }
  //  echo "<br> Available to Lay:   ";

    foreach ($runner->ex->availableToLay as $availableToLay){
    //  echo $availableToLay->size . "@" . $availableToLay->price . " | ";
      $lowestLay[] = $availableToLay->price;	 // add price to array
    }
  //get element 0 from array and calculate edge
  foreach ($runner->ex->availableToLay as $availableToLay){
  $lowestLayPrice = $availableToLay->price;
  $lowestLayAmount = $availableToLay->size;
  break;} //break so that only element 0 is passed

  foreach ($runner->ex->availableToBack as $availableToBack){
  $highestBackPrice = $availableToBack->price;
  $highestBackAmount = $availableToBack->size;
  break;}//break so that only element 0 is passed

  if(isset($lowestLayPrice,$lowestLayAmount,$highestBackPrice,$highestBackPrice)) { // check this code to see if working
  print_r("<br> lowest lay price: " .$lowestLayPrice. "<br>");
  //print_r("lowest lay amount: " .$lowestLayAmount. "<br>");
  //print_r("highest Back lay amount: " .$highestBackAmount. "<br>");
  //print_r("highest Back lay price: " .$highestBackPrice. "<br>");
  $weightedPrice = $highestBackPrice+(($highestBackAmount/($highestBackAmount+$lowestLayAmount))*($lowestLayPrice-$highestBackPrice));
  $weightedPrice = number_format((float)$weightedPrice, 2, '.', '');
  //print_r("weighted price is: ((".$highestBackAmount."/(".$highestBackAmount."+".$lowestLayAmount."))*(".$lowestLayPrice."-"
  //.$highestBackPrice.")) which is: ".number_format((float)$weightedPrice, 2, '.', ''). "<br>");
  //print_r($bestpricescrape);




    //print_r("<br> each way from oddschecker: " .$eachwaypricescrapesingle."<br>");
//$i = 0; //reinitialise
    $bestpricerunner = $bestpricescrape2[$j];
    //print_r($bestpricerunner);
    //echo"<h3>bestprice runner from place function ".$bestpricerunner."</h3>";
    $j++;
    //echo "\n best price from oddschecker: " .$bestpricescrape[$i]. "<br>";$i++;

    //print_r("Place price is oddschecker best price - 1(".$bestpricerunner."- 1".") is:  " .($bestpricerunner -1). " divided by each way terms +1(".$eachwaypricescrapesingle."- 1".") is:  "
     //.($eachwaypricescrapesingle +1)." gives you ". (($bestpricerunner-1)*($eachwaypricescrapesingle+1)). " <br>");
  $placePrice = (($bestpricerunner-1)*($eachwaypricescrapesingle)+1);

   //print_r("win edge method 1 is odds place  price: ".$placePrice." divided by lowest lay price (".$lowestLayPrice.") minus
    //1:  ".(($placePrice/$lowestLayPrice)-1).  "  or   ".number_format(((float)(($placePrice/$lowestLayPrice)-1) * 100 ), 2, '.', '')."%<br>");
    $row7[] = number_format(((float)(($placePrice/$lowestLayPrice)-1) * 100 ), 2, '.', '');

   //print_r("win edge method 2 is odds dds place  price: ".$placePrice." divided by weighted price (".$weightedPrice.") minus 1: "
   //.(($placePrice/$weightedPrice)-1).  "  or   ".number_format(((float)(($placePrice/$weightedPrice)-1) * 100 ), 2, '.', '')."%<br>");
   $row8[] = number_format(((float)(($placePrice/$weightedPrice)-1) * 100 ), 2, '.', '');

  }//end if
  }


  //code to sort horses in place
  $counter = 0;
     /*  some testing loops
    echo "<h4>Place horses from odds checker</h4>";
     foreach ($horses as $name){
       echo $name->name;
       echo "<br>";
     }
    
     echo "<br>";
     echo "<h4>Place horses from betfair</h4>";
     foreach ($nextHorseRacingMarket->runners as $runner) {
       	echo $runner->runnerName;
         echo "<br>";}
         echo "<br>";
      */
   
     echo "<br>";
    // sorting horses needs to be checked
     foreach ($nextHorseRacingMarket->runners as $runner) {
        if (strtolower($horses[$counter]->name) == strtolower($runner->runnerName)){
          $sortedArray[] = $horses[$counter];
           $counter = $counter +1;
        }
        else{ 
          foreach ($horses as $name){
             if ($name->name == $runner->runnerName){
            $sortedArray[] = $name;
            $counter = $counter +1;}
          }
        }
     }  
            
      /*  some testing loops
         echo "<br>";
         echo "<h4>Place horses sorted</h4>";
           foreach ($sortedArray as $newName){
       echo $newName->name;
        echo "<br>";}
      */

      foreach( $sortedArray as $horse ){
$bestpricescrape2[] = $horse->bestPrice; // redefine the best price  redefine all again
echo"<h3>horse price sorted place function ".$horse->bestPrice."</h3>";   

 // print_r("Best Price: ".$horse->bestPrice);
 // echo "<br>";

  //echo "Available from:<br>";
  $bestbookie = array();
  foreach($horse->bestBookmakers as $bookmaker){
    $bestbookie[] = $bookmaker;
   // print_r($bookmaker);
   //echo "<br>";
 }

 //arrprint_r(key($bestbookie));
  $bestbookies[] = $bestbookie;
      }
  
      //echo"<h3>bestprice scrape from place function </h3>";print_r($bestpricescrape2);


		foreach ($nextHorseRacingMarket->runners as $runner) {
			//echo "</br>==============================================================================\n";
			//echo "SelectionId: " . $runner->selectionId . " RunnerName: " . $runner->runnerName . "</br>";
     
     
       
      $row0[] = $runner->runnerName;
      echo printAvailablePrices2($runner->selectionId, $marketBook); 
  }
}
//***************************************************************end duplicate************************************************************************


  function convertToDecimal ($fraction) // function to convert a fraction to a decimal
   {
       $numbers=explode("/",$fraction);
       return round($numbers[0]/$numbers[1],6);
   }




	function printBetResult($betResult)
	{
		echo "Status: " . $betResult->status;
		if ($betResult->status == 'FAILURE') {
			echo "\nErrorCode: " . $betResult->errorCode;
			echo "\n\nInstruction Status: " . $betResult->instructionReports[0]->status;
			echo "\nInstruction ErrorCode: " . $betResult->instructionReports[0]->errorCode;
		} else
			echo "Warning!!! Bet placement succeeded !!!";
	}

	function sportsApingRequest($appKey, $sessionToken, $operation, $params)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.betfair.com/exchange/betting/rest/v1/$operation/");
		curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // new code for ssl
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);    // new code for ssl



		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Application: ' . $appKey,
			'X-Authentication: ' . $sessionToken,
			'Accept: application/json',
			'Content-Type: application/json'
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		debug('Post Data: ' . $params);
		$response = json_decode(curl_exec($ch));
		debug('Response: ' . json_encode($response));
		$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($http_status == 200) {
			return $response;
		} else {
			echo 'Call to api-ng failed: ' . "\n";
			echo  'Response: ' . json_encode($response);
			exit(-1);
		}
	}

	function debug($debugString)
	{
		global $DEBUG;
		if ($DEBUG)
			echo $debugString . "\n\n";
	}




?>

