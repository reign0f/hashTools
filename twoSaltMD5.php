//This code prepends one salt to the contents of a chosen password file, then appends a second salt to that same file.  
//It then uses MD5 to hash every concatenated string in the file and prints the result to another file of your choosing.
//This is most useful if you have user hashes already to compare the output to a known hash.
//Make sure your password file is in the same directory as twoSaltMD5.php and that you have write permissions in the directory.

<?php
$LEADING_SALT = "enter the salt you want prepended here";
$TRAILING_SALT = "enter the salt you want to append here";

function passwordfile()
{
    global $LEADING_SALT, $TRAILING_SALT;

    // Open the passwd.txt file for reading
    $pwd_file = fopen("nameOfYourPasswordTextFileHere.txt", "r");
    if (!$pwd_file) {
        die("Could not open passwd.txt file for reading");
    }

    // Initialize the output file handle and line counter
    $outputFilename = 'nameYourOutputFileHere.txt';
    $outputHandle = fopen($outputFilename, 'w');
    if (!$outputHandle) {
        die("Could not open the file for writing");
    }
    $lineCounter = 1;

    // Read each line from the password file, modify it, and write it to the output file
    while (!feof($pwd_file)) {
        $password = fgets($pwd_file);
        if ($password != ' ') {
            // Prepend the line number and a space to the modified line
            $modifiedLine = $lineCounter . ' ' . $LEADING_SALT . $password . $TRAILING_SALT;
            $hash = md5($modifiedLine);
            fwrite($outputHandle, $modifiedLine . ' ' . $hash . "\n");
            $lineCounter++;
        }
    }

    // Close the file handles
    fclose($pwd_file);
    fclose($outputHandle);
}
?>
