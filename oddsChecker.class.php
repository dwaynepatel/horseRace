<?php
require_once 'scraper.class.php';
class oddsChecker extends scraper{



    public $approvedBookmakers = array();

    public $ignoredExchanges = array(
                                    'BD'=>'Betdaq',
                                    'BF'=>'Betfair'
                                    );
    function __construct($arrString=array()){
      $this->approvedBookmakers = $arrString;

        //get list of approved bookmakers
    }

//**********************************************************************************************************************************

    function getRacePrices($races){
        // $races is an array of races, which are arrays with venueName(string) and time(DateTime)

        // check if the $races list is a single venue, if so repackage as an array of arrays
        if(isset($races['venueName'])){
            $races = array($races);
        }

        $urls = array();
        foreach( $races as $raceIndex=>&$race ){
            //If the race is tomorrow, then the date needs to the prepended to the event name
            if($race['time'] > (new DateTime('midnight +24 hours'))){
                $race['venueName'] = (new DateTime('midnight +24 hours'))->format('Y-m-d')." ".$race['venueName'];
            }
            //Reaplce spaces with dashes
            $race['venueName'] = str_replace(" ", "-", $race['venueName']);
            $world = "";
            if($race['country']!="IE" && $race['country']!="GB" && $race['country']!="AE" ){
                $world="world/";
            }
            $urls[$raceIndex]='https://www.oddschecker.com/horse-racing/'.$world.$race['venueName'].'/'.$race['time']->format('H:i').'/winner';
        }
		print_r($urls); // testing

        //Retrieve html from race page(s)
        $raceHtml = $this->multiRequest($urls);

        //print_r($raceHtml);
        foreach($races as $raceIndex=>&$race){
            $html = $raceHtml[$raceIndex];
            //Need to get bookmakers, after "view form" text.
            $bookmakerHtml = explode("View Form", $html);
            $bookmakerHtml = $bookmakerHtml[count($bookmakerHtml)-1];
            $bookmakerCodes = explode("<td data-bk=\"", $bookmakerHtml);
            $bookmakerCodesArray = array();
            foreach( $bookmakerCodes as $index=>$code){
                //Ignore first element
                if( $index != 0){
                    $code = substr($code, 0,2);
                    if( !in_array($code, $bookmakerCodesArray) ){
                        $bookmakerCodesArray[] = $code;
                    }else{
                        break;
                    }
                }
            }
            //Need to get each runner now..
            $runners = explode("data-bname=\"", $html);
            // print_r("html variable:".$html);    //testing
           // print_r("basic runners:".$runners);    testing
            $horses = array();
            foreach ($runners as $index=>$runner){
                if( $index != 0){
                    $horseHtml = explode("\"", $runner);
                    //Need to get prices...
                    $prices = explode("data-odig=\"", $runner);
                    $priceArray = array();
                    foreach ($prices as $index2=>$price){
                        if( $index2 != 0){
                            $price = explode("\"", $price);
                            $priceArray[] = $price[0];
                        }
                    }
                 //**********************test each way****************************
                 // this will give an array of each way but not necseeary as one is enough
                 $eachWay = explode("data-ew-div=\"", $html);  // used the class with extra " at the end and \
                    $eachWayArray = array();
                    foreach ($eachWay as $index3=>$ew){
                        if( $index3 != 0){
                            $ew = explode("\"", $ew);
                            $eachWayArray[] = $ew[0];
                        }
                    }
                 //**************************************************

                  //**********************test each way number of places****************************
                 // this will give an array of each way but not necseeary as one is enough
                 $eachWayPlace = explode("data-ew-places=\"", $html);  // used the class with extra " at the end and \
                    $eachWayPlaceArray = array();
                    foreach ($eachWayPlace as $index3=>$ewp){
                        if( $index3 != 0){
                            $ewp = explode("\"", $ewp);
                            $eachWayPlaceArray[] = $ewp[0];
                        }
                    }
                 //**************************************************

                    $newHorse = new stdClass;
                    $newHorse->name = $horseHtml[0];
                    $newHorse->prices = $priceArray;
                    $newHorse->eachWay = $eachWayArray;
                    $newHorse->eachWayPlace = $eachWayPlaceArray;
                    $horses[] = $newHorse;
                }
            }
            //Now have all prices, horse names and bookmakers
            //Need to find the best prices and corresponding bookmakers
            foreach( $horses as $horseIndex => &$horse ){
                $bestPrice = 0;
                $bestBookmakers = array();
                foreach( $horse->prices as $index=> $price ){
                    if( $price >= $bestPrice && isset($this->approvedBookmakers[$bookmakerCodesArray[$index]]) ){
                        if($price > $bestPrice){
                            //reset array
                            $bestBookmakers = array();
                        }
                        $bestBookmakers[$bookmakerCodesArray[$index]] = $this->approvedBookmakers[$bookmakerCodesArray[$index]];
                        $bestPrice = $price;
                    }
                }

                $horse->bestPrice = $bestPrice;
                $horse->bestBookmakers = $bestBookmakers;

            }
            print_r($bestBookmakers);
            return $horses;
        }
    } // end getRacePrices
}  // end oddsChecker class
?>
