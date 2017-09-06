<?php
require('oddsChecker.class.php');
require('reuse/page_init.php');
require('simple_scraping_library/simple_html_dom.php');
$time ="";
?>
<!DOCTYPE html >
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="checklist_model.js"></script>

  </head>
  <body>

     <?php
     require('reuse/login_template.php');
     if($_SESSION['username']){
         echo "<div class='well'>Scraping</div>";

         $url = 'https://www.oddschecker.com/horse-racing';
         $html = str_get_html(file_get_contents($url));

         // array of elements with race name and time
         $elements = [];
         // Find all links
         foreach($html->find('div#mc section') as $element)
            $elements[] = $element;

         //find header tag and print
         foreach($elements[0]->find('header') as $header){
            echo "<div class='well'>";
            echo $header;
            echo "</div>";
          }
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
                      <input type="checkbox" checklist-model="selected.bookmakers" checklist-value="bookmaker" /> {{bookmaker.name}}</label><br>
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
                echo $time;
                $timeNow = date('H:i'); // print time in hour and minute
                date_default_timezone_set('Europe/Dublin'); // set timezone
                if( strtotime($timeNow)<=strtotime($time) )  // if time now is greater than race time then dont  add to array 
                {
                  echo date('H:i'); // print time in hour and minute
                }
                else
                {
                 echo "no";
                }
                

                //echo "<br>";
            }
          }
          echo "</div>";

        }?>
        </div>
      </div>
     </form>
    </body>
</html>
