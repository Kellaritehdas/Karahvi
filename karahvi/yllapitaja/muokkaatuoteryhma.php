<?php
require "headery.php";

$ryhma_id=$_REQUEST['ryhma_id'];
$query = "SELECT * from tuoteryhma where ryhma_id='".$ryhma_id."'"; 
$result = mysqli_query($yhteys, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<div class="container"> 
	<div class="col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading"><center> Päivitä tiedot </center></div>	
			<div class="wrapper">
				<?php
				$status = "";
				if(isset($_POST['new']) && $_POST['new']==1)
				{

				$ryhma_id =$_REQUEST['ryhma_id'];
				$ryhma_nimi = ($_REQUEST['ryhma_nimi']);
				$kuvaus = $_REQUEST['kuvaus'];

				$update="update tuoteryhma set 
				ryhma_nimi='".$ryhma_nimi."',
				kuvaus='".$kuvaus."'
				where ryhma_id='".$ryhma_id."'";
				mysqli_query($yhteys, $update) or die(mysqli_error());
				$status = "Tiedot päivitetty. </br></br>
				<a href='tuoteryhmayllapitaja.php'>Takaisin tuoteryhmiin</a>";
				echo '<p style="color:#FF0000;">'.$status.'</p>';
				}else {
				?>
				<div>
					<form name="form" method="post" action=""> 
					<input type="hidden" name="new" value="1" />
					<input name="tuote_id" type="hidden" value="<?php echo $row['tuote_id'];?>" />
					<label>Tuoteryhmän nimi</label>
					<p><input type="text" class="form-control" name="ryhma_nimi" placeholder="Tuoteryhmän nimi" 
					required value="<?php echo $row['ryhma_nimi'];?>" /></p>
					<label>Tuoteryhmän kuvaus</label>
					<p><textarea class="form-control" name="kuvaus" placeholder="Tuoteryhmän kuvaus" 
					/><?php echo $row['kuvaus'];?></textarea></p>
					<input type="hidden" name="ryhma_id" value="<?php echo $row["ryhma_id"]; ?>" />
					<p><button class="btn btn-primary btn-sm" name="submit" type="submit" value="Update">PÄIVITÄ</button> 
					<button class="btn btn-default btn-sm"> <a href="tuoteryhmatyllapitaja.php" />PERUUTA</a></button></p>
					</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require "footer.php";
?>
	