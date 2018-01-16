<?php
//define("ENCRYPTION_KEY", "74hjdj38du3ojxe");
////$string = "This is the original data string!";
//
//echo $encrypted = encrypt($string, ENCRYPTION_KEY);
//echo "<br />";
//echo $decrypted = decrypt($encrypted, ENCRYPTION_KEY);
//
//function encrypt($pure_string, $encryption_key) {
//	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
//	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
//	$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
//	return $encrypted_string;
//}
//
///**
// * Returns decrypted original string
// */
//function decrypt($encrypted_string, $encryption_key) {
//	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
//	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
//	$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
//	return $decrypted_string;
//}

//    # --- ШИФРОВАНИЕ ---
//
//    # ключ должен представлять собой случайную бинарную строку.
//    # Для преобразовангия строки в ключ используйте scrypt, bcrypt или PBKDF2
//    # Ключ задается в виде строки шестнадцатеричных чисел
//    $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
//
//    # Показываем длину ключа.
//    # Длина ключа должна быть 16, 24 или 32 байт для AES-128, 192 и 256 соответственно
//    $key_size =  strlen($key);
//    echo "Длина ключа: " . $key_size . "\n";
//
//    $plaintext = "This string was AES-256 / CBC / ZeroBytePadding encrypted.";
//
//    # Создаем случайный инициализирующий вектор используя режим CBC
//    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
//    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
//
//    # Создаем шифрованный текст совместимыс с AES (размер блока = 128)
//    # Подходит только для строк не заканчивающихся на 00h
//    # (потому как это символ дополнения по умолчанию)
//    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
//	    $plaintext, MCRYPT_MODE_CBC, $iv);
//
//    # Добавляем инициализирующий вектор в начало, чтобы он был доступен для расшифровки
//    $ciphertext = $iv . $ciphertext;
//
//    # перекодируем зашифрованный текст в base64
//    $ciphertext_base64 = base64_encode($ciphertext);
//
//    echo '<br>';
//    echo  $ciphertext_base64 . "\n";
//
//    # === ВНИМАНИЕ ===
//
//    # Результирующий шифрованный текст не имеет целостности или аутентичности и не
//    # защищен от атак padding oracle.
//
//    # --- ДЕШИФРОВКА ---
//
//    $ciphertext_dec = base64_decode($ciphertext_base64);
//
//    # Извлекаем инициализирующий вектор. Длина вектора ($iv_size) должна совпадать
//    # с тем, что возвращает функция mcrypt_get_iv_size()
//    $iv_dec = substr($ciphertext_dec, 0, $iv_size);
//
//    # Извлекаем зашифрованный текст
//    $ciphertext_dec = substr($ciphertext_dec, $iv_size);
//
//    # Отбрасываем завершающие символы 00h
//    $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
//	    $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
//
//	echo '<br>';
//    echo  $plaintext_dec . "\n";

//$key is our base64 encoded 256bit key that we created earlier. You will probably store and define this key in a config file.
//$privateKey = "privateKey";
//$publicKey = "publicKey";
//
//function my_encrypt($data, $key) {
//	// Remove the base64 encoding from our key
//	$encryption_key = base64_decode($key);
//	// Generate an initialization vector
//	$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
//	// Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
//	$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
//	// The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
//	return base64_encode($encrypted . '::' . $iv);
//}
//
//function my_decrypt($data, $key) {
//	// Remove the base64 encoding from our key
//	$encryption_key = base64_decode($key);
//	// To decrypt, split the encrypted data from our IV - our unique separator used was "::"
//	list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
//	return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
//}
//
////our data to be encoded
//$password_plain = 'abc123';
//echo "Initial string : " . $password_plain . "<br>";
//
////our data being encrypted. This encrypted data will probably be going into a database
////since it's base64 encoded, it can go straight into a varchar or text database field without corruption worry
//
//$prefix = "000000000000000000000000";
//
//$password_encrypted = $prefix.my_encrypt($password_plain, $privateKey);
//echo "First encryption : " . $password_encrypted . "<br>";
//
//$double_encrypted = my_encrypt($password_encrypted, $publicKey);
//echo "Second encryption : " . $double_encrypted . "<br>";
//
//$double_decrypted = my_decrypt($double_encrypted, $publicKey);
//echo "Second decryption : ".$double_decrypted . "<br>";
//
////now we turn our encrypted data back to plain text
//$password_decrypted = my_decrypt(substr($double_decrypted, strlen($prefix)), $privateKey);
//echo $password_decrypted . "<br>";

//$digests             = openssl_get_md_methods();
//$digests_and_aliases = openssl_get_md_methods(true);
//$digest_aliases      = array_diff($digests_and_aliases, $digests);
//
//echo json_encode($digests);
//echo "<br><br>";
//echo json_encode($digest_aliases);

$stringToSign = "hey this is some data I want to sign to confirm I said it and no one else...";

$privateKey =
	"-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEA0PWnPjB5x8Xs+uV0GRCGGE8xlLU67sx6CDdAU7FBsBe8X7pt
065MAUwrtRQvIhyKhd9wRg8LvgWm7vYnYi5tkdodOhRyVw+jd7Id9CsQwUNNG+JZ
vrEmHKCTXvWbv/fmL5DTCkRxoJj3KdNqUYA6M+JcGahgpGnsRmvWQ2mz4IZZi5ur
vjSPPdrBSWgts5uIv5tNfEwuEzbJtIENn0tysoksIiG/n8edBbxlTqCo8OJVfy1n
h21TdBEHsi9V0NyEtqAFKdHaZscA3yj9k2mWuqSg1c0VnGJ/+OmOvgLkDlz3f7vH
t7ULJxV/iyNdugh5XUD1YKRwhMqBqfTNlKyFvwIDAQABAoIBABEsPyRjQ37hi0pL
VTFCJGMXDxITmtZJQ7YtJEI8jRN1v+t2HNSKvIBWzDjDgeQhyFicNlPrpKFnQYLe
A/qTqjmUXVaKm6MADAUoREHu0B+x8kJaZdnAIUu0/qeNM9GhA+/gzRdI7LWwHI/5
agFsslvVPJB3QAoDEoHvFtrPcxL+kY+wZu8RUYG6TCX/QxD45iZhQkWFH6I6tXh+
5wO1Dt0sx1iQJYkaI9/iHGkKS04hnNCQKPSdBLx0p+w87W9aF3+hoafRGMLsHL8S
mzQTFTHryYdrczjFhFypPhgCm+gdm8OlhjpuRHdmEV6jm40snnPyq9w9gm1Etge9
v0otEjECgYEA7z8WOw0NGb+UHx8F+YKyaaVigkN/Pal0tBbBG/XIF2hubbldr3Z8
/XCfmY8sIdQvxOusSfD1aFCxS34t8V6kAerQKZ6p4+W4xb7+dF9/qfCqJXzQttug
M8EujgAdqlS+G/3FKzHBWmfTDlymLsldH2dC2I6U+Jo5kAzPyS5SxLsCgYEA35ef
E79OaCKNFGpK9VgsLnEKd9DtZS3abzOkx5242VRjWIjrsvEgLfuvLSGGYgSaeCMY
edsCQ3mfmS2Yjiov0eZ4b2PcK+16ndaGQceHwuoP/eeH/BGe+eLcDF/xBFx7yRnn
sVgDhePthBCwOOJm7M26cCVdMmO3GMHxopXdNM0CgYEAlfQvxeFfRbU7bOov/3y4
wNjlTopp1UdCG6JrdU/vEyTkmidmHhUhMGUH0+LWIXnyWvXwbgP2fWSeS5gRycis
+Xqo8H0/NNWGo4Mbz+sPhH+Q1aBO3V35IpdBy8Us0tb8tWSw0WsFKtoKgmT10Dtr
/8PkNQHhQ5S+4Zf2IL3FKQMCgYEAy4A0SMTVl/HadbpIfwTBMYOxA1wktPIG3S8j
yorCswsbYHk+DJ9pqnBn/6uDo7KM5MsMe9vZM5B+sevN7ZZ375LUCo3Y1iJOd1nI
2BXCeqSN6YnROprPFqBjpt+rfUyvXVk2hzKUAkhw5MJLoXpuMxkLlwZqzHH1M5NR
WakMrAECgYEA4Ij7J3591daJbS5+pFK7MujrSg6TTi2etyyXcNO6xIkEbiX69MIU
DZh9GfAVkh6k/WaA2MuThI39TZJiF0nBU+irQttK6LeVhZ2MK+dEJh7rTy1b7zv1
WXLfkc1viK7cnC2ROOChmRm64GURupdf7ACsR2r+vbTSEoevWKfXwIk=
-----END RSA PRIVATE KEY-----";

$publicKey =
	"-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0PWnPjB5x8Xs+uV0GRCG
GE8xlLU67sx6CDdAU7FBsBe8X7pt065MAUwrtRQvIhyKhd9wRg8LvgWm7vYnYi5t
kdodOhRyVw+jd7Id9CsQwUNNG+JZvrEmHKCTXvWbv/fmL5DTCkRxoJj3KdNqUYA6
M+JcGahgpGnsRmvWQ2mz4IZZi5urvjSPPdrBSWgts5uIv5tNfEwuEzbJtIENn0ty
soksIiG/n8edBbxlTqCo8OJVfy1nh21TdBEHsi9V0NyEtqAFKdHaZscA3yj9k2mW
uqSg1c0VnGJ/+OmOvgLkDlz3f7vHt7ULJxV/iyNdugh5XUD1YKRwhMqBqfTNlKyF
vwIDAQAB
-----END PUBLIC KEY-----";

$signature = null;
$alg       = OPENSSL_ALGO_SHA256;

if (openssl_sign($stringToSign, $signature, $privateKey, $alg)) {
	echo "Successfully signed data.<br>";

	$signature = base64_encode($signature); // as might be done in transport
	echo $signature."<br>";
	// verify which should succeed
	$success = openssl_verify($stringToSign, base64_decode($signature), $publicKey, $alg);

	if ($success === -1) {
		echo "openssl_verify() failed with error.  " . openssl_error_string() . "<br>";
	} elseif ($success === 1) {
		echo "Signature verification was successful!<br>";
	} else {
		echo "Signature verification failed.  Incorrect key or data has been tampered with<br>";
	}

	// verify which should fail because data has been tampered with
	$stringToSign .= "\nI am evil and demand you wire $1,000,000,000 to me.";

	$success = openssl_verify($stringToSign, base64_decode($signature), $publicKey, $alg);

	if ($success === -1) {
		echo "openssl_verify() failed with error.  " . openssl_error_string() . "<br>";
	} elseif ($success === 1) {
		echo "Signature verification was successful!<br>";
	} else {
		echo "Signature verification failed.  Incorrect key or data has been tampered with!<br>";
	}
} else {
	echo "openssl_sign() failed.  " . openssl_error_string() . "<br>";
}