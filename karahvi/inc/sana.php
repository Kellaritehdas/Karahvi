<?php
// Haetaan tiedot lomakkeelta
$email = $_REQUEST['email'];
$muuttuja = $_REQUEST['muuttuja'];
$merkki = $_REQUEST['merkki'];

$subject = 'Uusi salasana Karahviin';
$url = "http://(web-address)/luouusisalasana.php?muuttuja=".$muuttuja."&valinta=".$merkki;

$message = '<p>Olemme saaneet pyyntösi uusia salasana Karahviin.</p>';
$message .='<p>Jos teit pyynnön, aseta uusi salasana oheisesta linkistä.</p>';
$message .='<p>Jos et tehnyt tätä pyyntöä, poista tämä viesti.</p>';
$message .='<p>Linkki on voimassa 30 minuutin ajan.</p>';
$message .='<p>Linkki salasanan uusimista varten: </p>';
$message .='<a href="'.$url.'">'.$url.'</a></p></br>';
$message .='<p>Terveisin Karahvi!</p>';

// Täytä seuraavat kohdat omilla tiedoilla
$from = 'xx@xx.xx'; // Webhotelliin luodun sähköpostilaatikon osoite
$pass = 'password'; // Sähköpostilaatikon salasana
$to = $email; // Osoite johon viestit lähetetään

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Load composer's autoloader
// Tarkista kansio polut että ne vastaavat sitä miten purit phpMailerin webhotelliisi
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
// phpMailer osuus alkaa
$mail = new PHPMailer(true);
try {
 //Server settings
 $mail->SMTPDebug = 0; // Tähän voi asettaa myös "2", jolloin näkee enemmän tietoja lähetyksestä
 $mail->isSMTP();
 $mail->Host = 'localhost'; // Määritetään sähköpostipalvelin
 $mail->SMTPAuth = true;
 $mail->Username = $from; // Haetaan ylempänä annettu sähköpostiosoite
 $mail->Password = $pass; // Haetaan salasana
 $mail->SMTPSecure = '';
 $mail->SMTPAutoTLS = false;
 $mail->Port = 587;
 //Recipients
 $mail->setFrom($from, 'Karahvi'); // "Palaute" näkyy viestissä lähettäjän nimenä, jonka voitte valita vapaasti
 $mail->addAddress($to); // Haetaan ylempänä annettu osoite, johon viestit lähetetään
 $mail->addReplyTo($email); // Haetaan lomakkeeseen täytetty sähköpostiosoite
 //Content
 $mail->isHTML(true);
 $mail->Subject = $subject; // Vapaavalintainen viestin otsikko
 $mail->Body = $message; // Haetaan lomakkeeseen täytetty viesti
 $mail->AltBody = $message; // Haetaan lomakkeeseen täytetty viesti

 $mail->send();
// echo 'Tilaus lähetetty onnistuneesti!'; // Ilmoitus viestin lähtyksen onnistumisesta
 echo "<script>location.href='../uusisalasana.php?reset=onnistui';</script>"; // Esimerkki uudelleen ohjauksesta toiselle sivulle
} catch (Exception $e) {
 echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo; // Ilmoitus viestin lähetyksen epäonnistumisesta
// echo "<script>location.href='epaonnistui.html';</script>"; // Esimerkki uudelleen ohjauksesta toiselle sivulle
}