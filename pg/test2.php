<?php
// Configuration settings for the key
$config = array(
	"digest_alg" => "sha256",
	"private_key_bits" => 384,
	"private_key_type" => OPENSSL_KEYTYPE_RSA,
);

// Create the private and public key
$res = openssl_pkey_new($config);

// Extract the private key into $private_key
openssl_pkey_export($res, $private_key);

// Extract the public key into $public_key
$public_key = openssl_pkey_get_details($res);
$public_key = $public_key["key"];

echo "Public key: $public_key<br>";
echo "Private key: $private_key<br><br>";

// Something to encrypt
$text = 'This is the text to encrypt';

echo "This is the original text: $text<br><br>";

// Encrypt using the public key
openssl_public_encrypt($text, $encrypted, $public_key);

$encrypted_hex = bin2hex($encrypted);
echo "This is the encrypted text: $encrypted_hex<br><br>";

// Decrypt the data using the private key
openssl_private_decrypt($encrypted, $decrypted, $private_key);

echo "This is the decrypted text: $decrypted<br><br>";