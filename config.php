<?php

// User settings
// Edit the parameters in this file to cusomise your KitchenTV


// ##### ASPECT ####
// If your TV aspect is more sqaure than regular widescreen you can use the 4:3 mode
// m43 = 4:3 aspect, m169 = 16:9 aspect
//$aspect ="m43";
$aspect ="m169";

// ##### Date / Timezone #####
// You can safely disable my default timezone by adding // to the start of the line.
date_default_timezone_set("Asia/Tokyo"); 
// You do not need to edit this unless you know what you are doing.
$date= strtoupper(date("M jS l", time()));

// ##### Weather #####
// see weather.js file
// weather location - examples: "Manchester, England", "Paris, Texas", "Paris, France"
// or check on Yahoo weather if you have trouble,
$wloc="Nanjo-shi";
// weather forecast days, MAX 9
$wdays=4;
// Temperature units; C or F
$wunit = "C";

// ##### IP Checker, 0=off 1=on #####
$ipchecker=0;

// ##### IP Refresh Time #####
$ipRefreshTime = 3600*24;
$ip = "";

if(!isset($ip) || $ip == "") {
    if (file_exists("ip.cache") && (time() - filemtime("ip.cache") < $ipRefreshTime)) { 
        $ip = file_get_contents("ip.cache"); // Get the Cache File
    } else {
        // ##### Your IP address #####
            $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"https://api.ipify.org?format=text");
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);   // Disables HTTPS Check
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   // Disables HTTPS Check
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
            $ip = curl_exec($ch);

        // If curl has an issue use the alternative method. (Not Preferred)
        // CURL Error Codes: https://curl.haxx.se/libcurl/c/libcurl-errors.html
            if(curl_errno($ch)) {
                file_put_contents("error_curl.log", $date." - cURL said: ". curl_error($ch));
                $ip = file_get_contents("https://api.ipify.org?format=text");
            }
        
        if(!isset($ip) || $ip == "") { $ip = "0.0.0.0"; } //Set the IP to 0.0.0.0 since everything has failed.
        file_put_contents("ip.cache", $ip); // Put the Cache File
    }
}

// alternate file method - just create this text file with your IP & nothing else.
//$ip=file_get_contents('ip.txt');

// ##### YouTube #####
// Video streams
// name = a short name or abreviation to help you remmeber the channel. A 2 letter code is recommended; BB, FR, MC
// url = the youtube video ID
// time = to display the video in seconds
// mus = 0 or 1. mus=0 channels will switch between each other, as will mus=1, but they wont cross over unless you manually click.
// Its is designed to have MUSIC separate from other content. So you can put the Kitchen TV into music mode.

// Sky News
$streams[]=array(
    "name" => "SN",
    "url" => "y60wDzZt8yg",
    "time" => 1200,
    "mus" => 0
);

// Monstercat Music
$streams[]=array(
    "name" => "MC",
    "url" => "cCmJdLA5b1I",
    "time" => 1200,
    "mus" => 1
);

// France 24 News
$streams[]=array(
    "name" => "FR",
    "url" => "Fwxuzl4ZrHo",
    "time" => 1200,
    "mus" => 0
);

// Vibe Guide
$streams[]=array(
    "name" => "VG",
    "url" => "Ww5wO_lxOSk",
    "time" => 1200,
    "mus" => 1
);

// Nasa live
$streams[]=array(
    "name" => "NS",
    "url" => "RtU_mdL2vBM",
    "time" => 300,
    "mus" => 0
);

// No Copyright Sounds
$streams[]=array(
    "name" => "NC",
    "url" => "1-AODuJpCG4",
    "time" => 1200,
    "mus" => 1
);

// Some channels change their url frequently, so watch out for that & pick what works for you.


// ##### News Feed #####
// url of RSS news feed
// this works off <title> <description> & <link> so those elements must be present in the XML doc

//$news_url="http://www.aljazeera.com/xml/rss/all.xml";
$news_url="http://feeds.bbci.co.uk/news/rss.xml?edition=uk";
//$news_url="http://feeds.bbci.co.uk/news/world/us_and_canada/rss.xml";
//$news_url="https://news.google.com/news?cf=all&hl=en&pz=1&ned=us&output=rss";
//$news_url="http://www.techradar.com/rss";

// ###### Weather Underground alerts ####
// your local weather station page to extract alerts from
$wupage="https://www.wunderground.com/q/zmw:90001.1.99999";
// uncomment "wu_advisory" on index.php to start using


?>
