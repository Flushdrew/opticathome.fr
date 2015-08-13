<?php

  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $headers .= 'FROM:' . htmlspecialchars($_POST['email']);
  $to = 'contact@opticathome.fr'; // Insérer votre adresse email ICI
  $subject = 'Demande envoyée par ' . htmlspecialchars($_POST['nom']) .' ' . htmlspecialchars($_POST['prenom']) .' - Email : ' . htmlspecialchars($_POST['email']) .'';
  $message_content = '
  <table>
  <tr>
  <td><b>Demande de devis de la part de :</b></td>
  </tr>
  
  <tr>
  <td>'. htmlspecialchars(strtoupper($_POST['nom'])) . ' ' .htmlspecialchars($_POST['prenom']).'</td>
  </tr>
  
  <tr>
  <td><b>Email:</b></td>
  </tr>
  
  <tr>
  <td>'. htmlspecialchars($_POST['email']) .'</td>
  </tr>
  
  <tr>
  <td><b>Téléphone:</b></td>
  </tr>
  
  <tr>
  <td>'. htmlspecialchars($_POST['telephone']) .'</td>
  </tr>
  
  <tr>
  <td><b>Cette demande concerne:</b></td>
  </tr>
 
  <tr>
  <td>' . (isset($_POST['montures']) ? 'montures' : '') .'</td>
  </tr>
  <tr>
  <td>' . (isset($_POST['verres']) ? 'verres' : '') .'</td>
  </tr>
  <tr>
  <td>' . (isset($_POST['lentilles']) ? 'lentilles' : '') .'</td>
  </tr>
 
  <tr>
  <td><b>Message:</b></td>
  </tr>
  
  <tr>
  <td>'. htmlspecialchars($_POST['message']) .'</td>
  </tr>
  
  </table>
  ';
  mail($to, $subject, $message_content, $headers);

  header('Location: index.html');
  
  ?>
 