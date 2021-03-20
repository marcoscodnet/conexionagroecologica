<?php
include_once('../bootstrap.php');
$fecha = date('d-m-Y');
/*$emails = Doctrine::getTable('newsletter')->findAll();
$csv = '';
foreach ($emails as $email) {
	$csv .= $email->email.'; ';
}
$csv = substr($csv, 0, -2);*/

$emailsNewsletter = Doctrine_Query::create()
        ->select('u.email')
        ->from('Usuario u')
        ->where('u.id <> 1 and u.id <> 2')
        ->andWhere('u.email IS NOT NULL')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;
if (!is_array($emailsNewsletter)) $emailsNewsletter = array($emailsNewsletter);

$emailsUsuarios = Doctrine_Query::create()
        ->select('n.email')
        ->from('Newsletter n')
        ->where('n.email IS NOT NULL')
        ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
;
if (!is_array($emailsUsuarios)) $emailsUsuarios = array($emailsUsuarios);
$csv = implode("\n", array_merge($emailsNewsletter, $emailsUsuarios));

header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="newsletter_'.$fecha.'.csv"');
echo($csv);
?>