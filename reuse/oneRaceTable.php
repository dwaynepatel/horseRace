<?php
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
?>