<?php
require_once("twitteroauth/twitteroauth.php");

CONST CONSUMER_KEY = "";
CONST CONSUMER_SECRET = "";
CONST ACCESS_TOKEN = "";
CONST ACCESS_TOKEN_SECRET = "";
 
$twitter_oauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
    ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
 
$request = $twitter_oauth->OAuthRequest(
    "https://api.twitter.com/1.1/search/tweets.json", "GET", 
    array(
        "q" => urlencode("プログラミング"),
        "count" => 3
    )
);
 

$ret = json_decode($request);

if (isset($ret->{"errors"}) && $ret->{"errors"} != "") {
    echo "error";
} else {
    $i = 0;
    while (true) {
        if (isset($ret->{"statuses"}[$i]->{"text"})) {
            $line_num = $i+1;
            echo $line_num.$ret->{"statuses"}[$i]->{"text"}."<br><br>";
            $i++;
        }
    }
}