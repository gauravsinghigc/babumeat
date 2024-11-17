<?php
//foreach loop html tag attribute display
function LOOP_TagsAttributes($data)
{
 foreach ($data as $key => $values) {
  echo "$key='$values'";
 }
}

//remove space
function RemoveSpace($string)
{
 $string = str_replace(' ', '-', $string);
 if ($string == null) {
  return null;
 } else {
  return $string;
 }
}

//lowercase all words
function LowerCase($string)
{
 $string = strtolower($string);
 if ($string == null) {
  return null;
 } else {
  return $string;
 }
}
