<?php

date_default_timezone_set('Asia/Jakarta');
ulang:
// function change(){
os.system('clear');
echo color("nevy"," ===================================\n");
echo color("blue","  Auto create Gojek & Redeem voucher	\n");
echo color("green","             Mr. T0B1N9\n");
echo color("blue","  Time    : ".date('[d-m-Y] [H:i:s]')."\n");
echo color("blue","  Format Nomor 08/62 Pake Salah satu \n");
echo color("blue","           Proses regis Dulu   \n");
echo color("nevy"," Time    : ".date('[d-m-Y] [H:i:s]')."	\n");
echo color("purple","
 _____                     ______  _____ _____ 
|_   _|                    | ___ \|  _  |_   _|
  | | ___  __ _ _ __ ___   | |_/ /| | | | | |  
  | |/ _ \/ _` | '_ ` _ \  | ___ \| | | | | |  
  | |  __/ (_| | | | | | | | |_/ /\ \_/ / | |  
  \_/\___|\__,_|_| |_| |_| \____/  \___/  \_/  
                                               
                                               
\n");
echo color("nevy"," ===================================\n");
        $nama = nama();
        $email = str_replace(" ", "", $nama) . mt_rand(100, 999);
        echo color("nevy","        Proses menuju register                 \n");
        echo color("purple","Nomor : ");
        // $no = trim(fgets(STDIN));
        $nohp = trim(fgets(STDIN));
        $nohp = str_replace("62","62",$nohp);
        $nohp = str_replace("(","",$nohp);
        $nohp = str_replace(")","",$nohp);
        $nohp = str_replace("-","",$nohp);
        $nohp = str_replace(" ","",$nohp);

        if (!preg_match('/[^+0-9]/', trim($nohp))) {
            if (substr(trim($nohp),0,3)=='62') {
                $hp = trim($nohp);
            }
            else if (substr(trim($nohp),0,1)=='0') {
                $hp = '62'.substr(trim($nohp),1);
        }
         elseif(substr(trim($nohp), 0, 2)=='62'){
            $hp = '6'.substr(trim($nohp), 1);
        }
        else{
            $hp = '1'.substr(trim($nohp),0,13);
        }
    }
        $data = '{"email":"'.$email.'@gmail.com","name":"'.$nama.'","phone":"+'.$hp.'","signed_up_country":"ID"}';
        $register = request("/v5/customers", null, $data);
        if(strpos($register, '"otp_token"')){
        $otptoken = getStr('"otp_token":"','"',$register);
        echo color("nevy"," Masukkan OTP..")."\n";
        otp:
        echo color("purple"," Otp : ");
        $otp = trim(fgets(STDIN));
        $data1 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $otptoken . '"},"client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e"}';
        $verif = request("/v5/customers/phone/verify", null, $data1);
        if(strpos($verif, '"access_token"')){
        echo color("yellow","BERHASIL REGIST\n");
        $token = getStr('"access_token":"','"',$verif);
        $uuid = getStr('"resource_owner_id":',',',$verif);
        echo color("green","+] Token : ".$token."\n\n");
        save("token.txt",$token); 
}
}
{
echo color("nevy","        Proses menuju Login                  \n");

$ydf = new ydf();
/** 
@ step 1
return @type json contain <otpToken> 
*/
echo color("nevy"," ?] Ulangi Nomor : ");
$phoneNumber = trim(fgets(STDIN));
$getOTPToken = $ydf->loginRequest($phoneNumber);
$json = json_decode($getOTPToken, true);
$OTPToken = $json['data']['otp_token'];
echo color("nevy"," ?] Otp : ");
$otpCode = trim(fgets(STDIN));
echo color("green","  Auto Token ");
echo $OTPToken;
$getAccesstoken = $ydf->getAuthToken($OTPToken, $otpCode);
$json = json_decode($getAccesstoken, true);
$accesstoken = $json['access_token'];
$accesstoken = $json['access_token'];
echo "\n";
}

 
          


echo "\n".color("purple","SETPIN..!!!: y/n ");
         $pilih1 = trim(fgets(STDIN));
         if($pilih1 == "y" || $pilih1 == "Y"){
         //if($pilih1 == "y" && strpos($no, "628")){
         echo color("nevy","▬▬▬▬▬▬▬▬▬▬▬▬▬▬ PIN MU = 147258 ▬▬▬▬▬▬▬▬▬▬▬▬")."\n";
         $data2 = '{"pin":"147258"}';
         $getotpsetpin = request("/wallet/pin", $token, $data2, null, null, $uuid);
         echo color("purple", "Otp pin: "."\n");
         $otpsetpin = trim(fgets(STDIN));
         $verifotpsetpin = request("/wallet/pin", $token, $data2, null, $otpsetpin, $uuid);
         echo $verifotpsetpin;
         }else if($pilih1 == "n" || $pilih1 == "N"){
         die();
         }else{
         echo color("red","-] GAGAL!!!\n");}
