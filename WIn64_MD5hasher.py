import hashlib

# Open the input and output files
with open("output.txt", "r", encoding="utf-8") as infile, open("crackme.txt", "w") as outfile:
    # Read each line from the input file
    for line in infile:
        # Remove any trailing whitespace
        line = line.strip()
        
        # Calculate the MD5 hash of the line
        hash_object = hashlib.md5(line.encode())
        hash_hex = hash_object.hexdigest()
        
        # Write the hash to the output file
        outfile.write(hash_hex + "\n")
