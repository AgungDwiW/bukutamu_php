<?php
// $File = "key.txt"; 
// $key = openssl_random_pseudo_bytes(512);
// $Handle = fopen($File, 'w');
// fwrite($Handle, $key); 
// fclose($Handle); 

function decrypt ($ciphertext){
	$myfile = fopen("key.txt", "r") or die("Unable to open file!");
	$key=fread($myfile,filesize("key.txt"));
	fclose($myfile);
	$c = base64_decode($ciphertext);
	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
	$iv = substr($c, 0, $ivlen);
	$hmac = substr($c, $ivlen, $sha2len=32);
	$ciphertext_raw = substr($c, $ivlen+$sha2len);
	$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
	$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
	if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
	{
	    return $original_plaintext;
	}
}

function encrypt ($plaintext){
	$myfile = fopen("key.txt", "r") or die("Unable to open file!");
	$key=fread($myfile,filesize("key.txt"));
	fclose($myfile);
	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
	$iv = openssl_random_pseudo_bytes($ivlen);
	$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
	$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
	$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
	return $ciphertext;
}

?>