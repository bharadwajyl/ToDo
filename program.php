<?php
//Palindrome
$string = "babad";
$array = array();
for($i=0; $i<strlen($string); $i++ )   {  
  $palindrome = true; 
  $n = 1;     
  while($palindrome)  
  { 
    $word = substr($string, $i-$n, ($n*2)+1 ); 
    if( $word == strrev($word) ) { 
      $array[$word] = strlen($word);           
    } else { 
      $palindrome = false; 
    } 
    $n++; 
  } 
}
print"Given string is babad <br>Largest Palindrome: ".(array_search (max($array), $array));
?>
