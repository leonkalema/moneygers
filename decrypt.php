<?php
$encrypted = '8c6cb73c0b289987c3e28c20fa869f';
for ($c1=65; $c1<91; ++$c1) {
  for ($c2=65; $c2<91; ++$c2) {
    $attempt = chr($c1) . chr($c2);
    if (md5($attempt) == $encrypted) {
      echo 'Found! The original text was: ', $attempt;
      exit(0);
    }
  }
}
echo 'Sorry, unable to find original text.';
?>