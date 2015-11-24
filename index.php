<?php
require_once('TwitterAPIExchange.php');
 
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "XXX",
    'oauth_access_token_secret' => "XXX",
    'consumer_key' => "XXX",
    'consumer_secret' => "XXX"
);
 
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
 
$requestMethod = "GET";
 
$getfield = '?screen_name=kelseylegault&count=3';
 
$twitter = new TwitterAPIExchange($settings);

$string = json_decode($twitter->setGetfield($getfield)
     ->buildOauth($url, $requestMethod)
     ->performRequest(),$assoc = TRUE);

// error catch
if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>breaking news</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <section>
        <h1>BREAKING NEWS<span>&emsp; for news on the go visit kelseylegault.com/breakingnews</span></h1>
        <marquee id="marquee">
        <?php
            foreach($string as $items)
            {
                echo "@".$items['user']['screen_name'];
                echo ":&nbsp;".$items['text'];
                echo "&nbsp;Followers: ". $items['user']['followers_count']."&emsp;&emsp;&emsp;";
            }
        ?>
        </marquee>
    </section>
</body>
</html>