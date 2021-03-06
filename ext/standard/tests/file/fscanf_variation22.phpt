--TEST--
Test fscanf() function: usage variations - char formats with resource
--FILE--
<?php

/*
  Prototype: mixed fscanf ( resource $handle, string $format [, mixed &$...] );
  Description: Parses input from a file according to a format
*/

/* Test fscanf() to scan resource type using different char format types */

$file_path = __DIR__;

echo "*** Test fscanf(): different char format types with resource ***\n";

// create a file
$filename = "$file_path/fscanf_variation22.tmp";
$file_handle = fopen($filename, "w");
if($file_handle == false)
  exit("Error:failed to open file $filename");


// resource type variable
$fp = fopen (__FILE__, "r");
$dfp = opendir ( __DIR__ );

// array of resource types
$resource_types = array (
  $fp,
  $dfp
);

$char_formats = array( "%c",
		       "%hc", "%lc", "%Lc",
		       " %c", "%c ", "% c",
		       "\t%c", "\n%c", "%4c",
		       "%30c", "%[a-zA-Z@#$&0-9]", "%*c");

$counter = 1;

// writing to the file
foreach($resource_types as $value) {
  @fprintf($file_handle, "%s", $value);
  @fprintf($file_handle, "\n");
}
// closing the file
fclose($file_handle);

// opening the file for reading
$file_handle = fopen($filename, "r");
if($file_handle == false) {
  exit("Error:failed to open file $filename");
}

$counter = 1;
// reading the values from file using different char formats
foreach($char_formats as $char_format) {
  // rewind the file so that for every foreach iteration the file pointer starts from bof
  rewind($file_handle);
  echo "\n-- iteration $counter --\n";
  while( !feof($file_handle) ) {
    try {
      var_dump(fscanf($file_handle,$char_format));
    } catch (ValueError $exception) {
      echo $exception->getMessage() . "\n";
    }
  }
  $counter++;
}

// closing the resources
fclose($fp);
closedir($dfp);

echo "\n*** Done ***";
?>
--CLEAN--
<?php
$file_path = __DIR__;
$filename = "$file_path/fscanf_variation22.tmp";
unlink($filename);
?>
--EXPECT--
*** Test fscanf(): different char format types with resource ***

-- iteration 1 --
array(1) {
  [0]=>
  string(1) "R"
}
array(1) {
  [0]=>
  string(1) "R"
}
bool(false)

-- iteration 2 --
array(1) {
  [0]=>
  string(1) "R"
}
array(1) {
  [0]=>
  string(1) "R"
}
bool(false)

-- iteration 3 --
array(1) {
  [0]=>
  string(1) "R"
}
array(1) {
  [0]=>
  string(1) "R"
}
bool(false)

-- iteration 4 --
array(1) {
  [0]=>
  string(1) "R"
}
array(1) {
  [0]=>
  string(1) "R"
}
bool(false)

-- iteration 5 --
array(1) {
  [0]=>
  string(1) "R"
}
array(1) {
  [0]=>
  string(1) "R"
}
bool(false)

-- iteration 6 --
array(1) {
  [0]=>
  string(1) "R"
}
array(1) {
  [0]=>
  string(1) "R"
}
bool(false)

-- iteration 7 --
Bad scan conversion character " "
Bad scan conversion character " "
bool(false)

-- iteration 8 --
array(1) {
  [0]=>
  string(1) "R"
}
array(1) {
  [0]=>
  string(1) "R"
}
bool(false)

-- iteration 9 --
array(1) {
  [0]=>
  string(1) "R"
}
array(1) {
  [0]=>
  string(1) "R"
}
bool(false)

-- iteration 10 --
array(1) {
  [0]=>
  string(4) "Reso"
}
array(1) {
  [0]=>
  string(4) "Reso"
}
bool(false)

-- iteration 11 --
array(1) {
  [0]=>
  string(8) "Resource"
}
array(1) {
  [0]=>
  string(8) "Resource"
}
bool(false)

-- iteration 12 --
array(1) {
  [0]=>
  string(8) "Resource"
}
array(1) {
  [0]=>
  string(8) "Resource"
}
bool(false)

-- iteration 13 --
array(0) {
}
array(0) {
}
bool(false)

*** Done ***
