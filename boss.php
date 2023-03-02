<?php
$LEADING_SALT = "soMe3FK2J+YFAMzUjwpfpA";
$TRAILING_SALT = "6dcKXY3x/JRZbyj9RDB/Lw";

function passwordfile()
{
    global $LEADING_SALT, $TRAILING_SALT;

    // Open the passwd.txt file for reading
    $pwd_file = fopen("passwd.txt", "r");
    if (!$pwd_file) {
        die("Could not open passwd.txt file for reading");
    }

    // Initialize the output file handle and line counter
    $outputFilename = 'bossHash.txt';
    $outputHandle = fopen($outputFilename, 'w');
    if (!$outputHandle) {
        die("Could not open bossHash.txt file for writing");
    }
    $lineCounter = 1;

    // Read each line from the passwd.txt file, modify it, and write it to the output file
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
