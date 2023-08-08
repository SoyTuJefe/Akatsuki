<?php 

$conn = mysqli_connect("localhost", 'id21118023_akatsukiuser' , 'Spotty#03', "id21118023_akatsukidb") or die("Connection fail");

$websiteTitle = "Akatsuki"; // Website Name
$websiteUrl = "//{$_SERVER['SERVER_NAME']}";  // Website URL
$websiteLogo = $websiteUrl . "/files/images/akatsuki.png"; // Logo
$contactEmail = "animeflv.sc@gmail.com"; // Contact Email

$version = "0.5";

//Donate 
$donate = "#";

// Socials 
$telegram = "https://t.me/+HP0rBmi1qwQ5MmQx"; // telegram
$discord = "https://discord.gg/5CqcPHKf"; // Discord
$redit = "#"; // Reddit
$twitter = "#"; // Twitter
 


$disqus = "https://streamable-1.disqus.com"; // Disqus


$api = "https://animezia.onrender.com";


$cdn = "https://cdnzia.pages.dev"; 
//$api = "https://cloudy-jade-chimpanzee.cyclic.app";

$ani = "https://modern-school-uniform-clam.cyclic.app";

// $iani = "hxxpz:qqapi*c=nzu?ex*=rg";
// $s1 = str_replace("x","t",$iani);
// $s2 = str_replace("z","s",$s1);
// $s3 = str_replace("q","/",$s2);
// $s4 = str_replace("*",".",$s3);
// $s5 = str_replace("?","m",$s4);
// $ani = str_replace("=","o",$s5);



$banner = $websiteUrl . "/files/images/banner.png";  //Banner
?>
