<?php
$con = new mysqli("localhost","root","","student");
if($con->connect_error){
	echo $con->connect_error;
}
?>
<?php
if(isset($_POST["submit"])){
	$name = $_POST["user_name"];
	$mail = $_POST["user_id"];
	$country = $_POST["country"];
	$city = $_POST["city"];
	$sql = "INSERT INTO country_store(name, mail, country, city) VALUES('$name','$mail','$country','$city')";
	if($con->query($sql)){
		echo "submitted successfully<br/>";
	}else{
		echo "";
	}
	$sql = "SELECT country_store.id, country_store.`name`, country_store.mail, country_city.country, country_city.city FROM country_store INNER JOIN country_city ON country_store.country = country_city.id AND country_store.city = country_city.id";
	$result = $con->query($sql);
	if($result->num_rows>0){
		while($row=$result->fetch_assoc()){
			echo $row['name'].' '.$row['mail'].' '.$row['country'].' '.$row['city'].'<br/>';
		}
	}
}
?>