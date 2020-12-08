<?php
#=---------------------------------------------=#
#=          Subdomain Scanner                  =#
#=        Author : 4LM05TH3V!L                 =#
#= thx: Ethical Hacker Indonesia, C99, IndoSec =#
#=           Made With Love                    =#
#----------------------------------------------=#
system("clear") or system("cls");
$green = "\e[0;32m";
$red = "\e[31;1m";
echo "
              __ 
           | /  \ |          //  \\
           \_\\  //_/         _\\()//_
           .'/()\'.        / //  \\ \
             \\  //          | \__/ |
           
        -{ Subdomain Scanner }-
      [?] Coded By 4LMO5TH3V!L [?]
[!] Ethical Hacker Indonesia - IndoSec [!]
";
echo "\nEnter Domain : ";
$domain = trim(fgets(STDIN));
$ch = curl_init();
$arr = array(
CURLOPT_URL => 'https://tools.hack.co.id/subdomain/',
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_POST => 1,
CURLOPT_POSTFIELDS => "domain=$domain",
CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; rv:78.0) Gecko/20100101 Firefox/78.0",
CURLOPT_COOKIEJAR => "cookie.txt");
curl_setopt_array($ch, $arr);
$exec = curl_exec($ch);
$patt = "'<td><a href=\"([^<]*)\">([^<]*)</a></td>'si";
preg_match_all("$patt", $exec , $resp);
for ($i=0; $i< count($resp[0]); $i++){
    $curl = curl_init();
    $arrx =  array($curl, 
    CURLOPT_URL => "https://subdomainfinder.c99.nl/uptime_checker.php?host=".$resp[2][$i]."&json=&token=44619",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_COOKIEJAR => "cookie.txt");
    curl_setopt_array($curl, $arrx);
    $exec = curl_exec($curl);
$data = json_decode($exec, true);
if($data['success'] == "true"){
echo "$green"; echo $data['host']; echo " => "; echo $data['code'];
echo "\n";
} else {
echo "$red"; echo $resp[2][$i]; echo " => Error Domain !\n";
}
}
unlink("cookie.txt");
?>
