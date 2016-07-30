<?php

//復号化するデータ
$crypt_text = 'qlYWTN5DjXqPQQjGfgKA7PjG/66njwBhBfyT/Pe9/YQ3ENvjOtirrA==';

//暗号化＆復号化キー
$key = md5('TMPTMPTMP');

//暗号化モジュール使用開始
$td  = mcrypt_module_open('des', '', 'ecb', '');
$key = substr($key, 0, mcrypt_enc_get_key_size($td));
$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

//暗号化モジュール初期化
if (mcrypt_generic_init($td, $key, $iv) < 0) {
  exit('error.');
  }

  //データを復号化
  $plain_text = mdecrypt_generic($td, base64_decode($crypt_text));

  //暗号化モジュール使用終了
  mcrypt_generic_deinit($td);
  mcrypt_module_close($td);

echo "復号前: ".$crypt_text."\n";
echo "復号後: ".$plain_text."\n";
