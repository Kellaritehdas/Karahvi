
<?php
require('inc/config.php');

function make_query($yhteys)
{
 $query = "SELECT * FROM mainokset ORDER BY kuva_id ASC";
 $result = mysqli_query($yhteys, $query);
 return $result;
}

function make_slide_indicators($yhteys)
{
 $output = ''; 
 $count = 0;
 $result = make_query($yhteys);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}

function make_slides($yhteys)
{
 $output = '';
 $count = 0;
 $result = make_query($yhteys);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $output .= '
   <img src="mainokset/'.$row["kuva_kuva"].'" alt="'.$row["kuva_nimi"].'"/>
   <div class="carousel-caption">
    <h3>'.$row["kuva_nimi"].'</h3>
   </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}

?>
