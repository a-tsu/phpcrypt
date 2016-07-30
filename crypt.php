<?php

//暗号化するデータ
$plain_text = 'この文字列が出れば成功';

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

  //データを暗号化
  $crypt_text = base64_encode(mcrypt_generic($td, $plain_text));

  //暗号化モジュール使用終了
  mcrypt_generic_deinit($td);
  mcrypt_module_close($td);

echo "暗号前: ".$plain_text."\n";
echo "暗号後: ".$crypt_text."\n";
