<?php
#=---------------------------------------------=#
#=          Subdomain Scanner                  =#
#=        Author : 4LM05TH3V!L                 =#
#=  thx: Ethical Hacker Indonesia, IndoSec     =#
#=           Made With Love                    =#
#=---------------------------------------------=#
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
$result = $resp[2][$i];
$res = "$result";
$url = $res;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$exec = curl_exec($curl);

if ($exec === false) {
    echo "$red"; echo $resp[2][$i]; echo " => Error Domain\n";
} else {
    $newUrl = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($newUrl !== $url) {
    echo "$green"; echo $resp[2][$i]; echo " => $newUrl\n";
    }
}
}
?>
