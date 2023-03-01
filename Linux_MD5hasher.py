import hashlib

def compute_MD5_hash(string, encoding='utf-8'):
    md5_hasher = hashlib.md5()
    md5_hasher.update(string.encode(encoding))
    return md5_hasher.hexdigest()

with open("output.txt") as f, open("crackme.txt", "w") as out_file:
    for line in f:
        hash_value = compute_MD5_hash(line)
        out_file.write(hash_value + "\n")
