<?php
use Api\Newsreader\GNewsEndpoint;
use Api\Newsreader\GNewsSearchEndpoint;
use Api\Newsreader\GNewsTopHeadlinesEndpoint;
use Api\Newsreader\GNewsHTTPRequest;

require_once 'src/utilities.php';
require_once 'vendor/autoload.php';
var_dump($_GET);
if (isset($_GET['search'])){
    $keywords = $_GET['keywords'];
    $type = '';
    if (isset($_GET['type'])){
        $type = $_GET['type'];
    }
    $language = '';
    $country = '';
    $fromDate = '';
    $toDate = '';
    $in = '';
    $sortBy = '';
    if (isset($_GET['language'])){
        $language = $_GET['language'];
    }
    if (isset($_GET['country'])){
        $country = $_GET['country'];
    }

    if (isset($_GET['fromDate'])){
        $fromDate = $_GET['fromDate'];
    }

    if (isset($_GET['toDate'])){
        $toDate = $_GET['toDate'];
    }

    if (isset($_GET['in'])){
        $in = $_GET['in'];
    }

    if (isset($_GET['sortBy'])){
        $sortBy = $_GET['sortBy'];
    }

    $topic = '';
    if (isset($_GET['top'])){
        $topic = $_GET['top'];
    }

    $gnewsEndpoint = null;
    if($type === 'search'){
        $gnewsEndpoint = new GNewsSearchEndpoint($keywords,$language,$country,$fromDate,$toDate,$in,$sortBy);
    }
    else if ($type === 'top-headlines'){
        $gnewsEndpoint = new GNewsTopHeadlinesEndpoint($topic,$keywords,$language,$country,$fromDate,$toDate);
    }

    $gnewsHTTPRequest = new GNewsHTTPRequest('https://gnews.io/api/v4/','2b24923499ae7fe88fd46f47a352ad0e',$gnewsEndpoint);
    print_r($gnewsHTTPRequest->createHTTPRequest());
    $curlcmd = curl_init();
    curl_setopt($curlcmd,CURLOPT_URL,$gnewsHTTPRequest->createHTTPRequest());
    curl_setopt($curlcmd, CURLOPT_RETURNTRANSFER, true);

    $articles = json_decode(curl_exec($curlcmd));

    //$articles = {"totalArticles":5289,"articles":[{"title":"'Authentically myself' beats medals for non-binary U.S. Olympic skateboarder","description":"Pictures of the American carrying a board showing “they/them” pronouns went viral, as Smith became one of the first Olympians to come out as non-binary","content":"This advertisement has not loaded yet, but your article continues below.\nShare this Story: 'Authentically myself' beats medals for non-binary U.S. Olympic skateboarder\n'Authentically myself' beats medals for non-binary U.S. Olympic skateboarder Pictu... [5577 chars]","url":"https://vancouversun.com/pmn/news-pmn/authentically-myself-beats-medals-for-non-binary-u-s-olympic-skateboarder/wcm/6a207350-4892-42d0-9056-9c9f49e42b91","image":"https://smartcdn.prod.postmedia.digital/theprovince/wp-content/uploads/2021/08/1330627088.jpg","publishedAt":"2021-08-18T07:00:00Z","source":{"name":"Vancouver Sun","url":"https://vancouversun.com"}},{"title":"South Carolina’s Staley opens the door for Olympic return","description":"COLUMBIA, S.C. (AP) — Dawn Staley might not be done with Olympic coaching after all.","content":"COLUMBIA, S.C. (AP) — Dawn Staley might not be done with Olympic coaching after all.\nStaley led the U.S. women to a basketball gold medal at the Tokyo Games earlier this month, then flatly said she would not return for another run at the Olympics in ... [991 chars]","url":"https://www.thestar.com/sports/basketball/ncaa/2021/08/17/south-carolinas-staley-opens-the-door-for-olympic-return.html","image":"https://images.thestar.com/PI-Ily1i_FCOEr2VzLHJt5ordH8=/1280x1024/smart/filters:cb(1629236531819)/https://www.thestar.com/content/dam/thestar/sports/basketball/ncaa/2021/08/17/south-carolinas-staley-opens-the-door-for-olympic-return/20210817170832-611c2af9b8e931431510d9ecjpeg.jpg","publishedAt":"2021-08-17T07:00:00Z","source":{"name":"Toronto Star","url":"https://www.thestar.com"}},{"title":"WAYNE'S WORLD: Canada's secret weapons","description":"Our young women athletes and Olympians have amazed their fellow Canadians with their performances at the Tokyo 2020 Olympic Games. There is no country except…","content":"Our young women athletes and Olympians have amazed their fellow Canadians with their performances at the Tokyo 2020 Olympic Games. There is no country except maybe the tiny island of Jamaica that is as proud as Canada is of our fabulous females.\nThis... [1388 chars]","url":"https://www.thewhig.com/opinion/columnists/waynes-world-canadas-secret-weapons","image":"https://smartcdn.prod.postmedia.digital/nexus/wp-content/uploads/2021/08/0813-sb-KJ-Column.jpg","publishedAt":"2021-08-16T07:00:00Z","source":{"name":"The Kingston Whig-Standard","url":"https://www.thewhig.com"}},{"title":"Raptors coach Nick Nurse commits to Canada’s Olympic basketball dream, just like his players will","description":"Nurse decided to stay on after it was agreed that players must commit to the national men’s program for three years, like they do in the U.S. Canada m...","content":"A three-year plan pitched in a Las Vegas meeting room may ultimately propel Canada to global significance in men’s basketball.\nStill stinging from missing the Tokyo Olympics — knocked out of a final shot by a vastly more cohesive group with undeniabl... [3574 chars]","url":"https://www.thestar.com/sports/basketball/2021/08/16/raptors-coach-nick-nurse-commits-to-canadas-olympic-basketball-dream-just-like-his-players-will.html","image":"https://images.thestar.com/HYGLfcjgC_-mzSkax28eCLNmBfw=/1200x800/smart/filters:cb(1629151856258)/https://www.thestar.com/content/dam/thestar/sports/basketball/2021/08/16/raptors-coach-nick-nurse-commits-to-canadas-olympic-basketball-dream-just-like-his-players-will/nick_nurse.jpg","publishedAt":"2021-08-16T07:00:00Z","source":{"name":"Toronto Star","url":"https://www.thestar.com"}},{"title":"Japanese taxpayers were shut out from Olympic venues, but they now they can foot the bill","description":"Every Olympic Games is expensive for the host city or nation, but those hosts typically have gains to show in return — including millions of tourists who spend…","content":"This advertisement has not loaded yet, but your article continues below.\nShare this Story: Japanese taxpayers were shut out from Olympic venues, but they now they can foot the bill\nJapanese taxpayers were shut out from Olympic venues, but they now th... [10704 chars]","url":"https://nationalpost.com/news/japanese-taxpayers-were-shut-out-from-olympic-venues-but-they-now-can-view-the-staggering-bill","image":"https://smartcdn.prod.postmedia.digital/nationalpost/wp-content/uploads/2021/08/Screen-Shot-2021-08-16-at-9.59.13-AM.jpg","publishedAt":"2021-08-16T07:00:00Z","source":{"name":"National Post","url":"https://nationalpost.com"}},{"title":"Canadian Olympic boycott of Beijing Games seems unlikely despite tensions with China","description":"The latest call for Canada to consider boycotting the 2022 Beijing Olympic Games is unlikely to spur Ottawa to confront tensions with China in the Olympic arena, due to an apparent lack of support for such an approach among most political parties.","content":"The latest call for Canada to consider boycotting the 2022 Beijing Olympic Games is unlikely to spur Ottawa to confront tensions with China in the Olympic arena, due to an apparent lack of support for such an approach among most political parties.\nYe... [7499 chars]","url":"https://www.cbc.ca/news/world/beijing-olympics-boycott-unlikely-canadian-political-parties-1.6139647","image":"https://i.cbc.ca/1.6139664.1628817192!/cpImage/httpImage/image.jpg_gen/derivatives/16x9_620/olympics-facilities-in-zhangjiakou-china.jpg","publishedAt":"2021-08-14T08:00:00Z","source":{"name":"CBC.ca","url":"https://www.cbc.ca"}},{"title":"Did anyone from Coquitlam win an Olympic medal?","description":"A Coquitlam soccer coach has just returned from his stint assisting Canada's national women's team win a gold medal at the Tokyo Olympics.","content":"A Coquitlam soccer coach has just returned from his stint assisting Canada's national women's team win a gold medal at the Tokyo Olympics.\nAdam Day's family set up a patriotic display at the front of their Coquitlam home when the assistant coach with... [6144 chars]","url":"https://www.vancouverisawesome.com/local-news/it-was-unbelievable-coquitlam-soccer-coach-basks-in-glow-of-olympic-gold-4221208","image":"https://www.vmcdn.ca/f/files/tricitynews/images/sports/0819-goldmedalcoach-2w.jpg;w=1140;h=821;mode=crop","publishedAt":"2021-08-13T23:00:00Z","source":{"name":"Vancouver Is Awesome","url":"https://www.vancouverisawesome.com"}},{"title":"Olympic champion Damian Warner on breaking myths, mental toughness in decathlon","description":"Canada's Damian Warner remembers people calling decathletes 'jack-of-all-trades, but masters of nothing.' If there was any doubt to his mastery, the Olympic champion has shattered it.","content":"Canada's Olympic gold medallist Damian Warner is still grappling with his tremendous achievements at the Tokyo Olympic Games.\nThe 31-year-old put down personal bests and Olympic records to achieve a lifelong dream. He was selected as Canada's flag-be... [5678 chars]","url":"https://www.cbc.ca/sports/olympics/summer/trackandfield/decathlon-heptathlon/damian-warner-tokyo-olympics-1.6139952","image":"https://i.cbc.ca/1.6140470.1628881314!/fileImage/httpImage/image.jpg_gen/derivatives/16x9_620/tokyo-olympics-athletics.jpg","publishedAt":"2021-08-13T20:17:37Z","source":{"name":"CBC.ca","url":"https://www.cbc.ca"}},{"title":"Olympic diver, avid knitter Tom Daley looking for yarn shops in Calgary","description":"Tom Daley is making a months-long stop in Canada before heading home to Britain to show off his bronze medal from the Tokyo Olympics.","content":"This advertisement has not loaded yet, but your article continues below.\nShare this Story: Olympic diver, avid knitter Tom Daley looking for yarn shops in Calgary\nOlympic diver, avid knitter Tom Daley looking for yarn shops in Calgary “If anyone’s go... [3441 chars]","url":"https://theprovince.com/entertainment/celebrity/olympic-diver-avid-knitter-tom-daley-looking-for-yarn-shops-in-calgary/wcm/1d372a8b-09db-4745-b8b5-5fc83ba65ed1","image":"https://smartcdn.prod.postmedia.digital/theprovince/wp-content/uploads/2021/08/90331733_212431206668505_6645943834852649896_n-e1628875783369.jpg","publishedAt":"2021-08-13T07:00:00Z","source":{"name":"The Province","url":"https://theprovince.com"}},{"title":"Olympic diver, avid knitter Tom Daley looking for Calgary yarn shops","description":"Tom Daley is making a months-long stop in Canada before heading home to Britain to show off his bronze medal from the Tokyo Olympics.","content":"This advertisement has not loaded yet, but your article continues below.\nShare this Story: Olympic diver, avid knitter Tom Daley looking for yarn shops in Calgary\nOlympic diver, avid knitter Tom Daley looking for yarn shops in Calgary Photo by Tom Da... [3511 chars]","url":"https://torontosun.com/entertainment/celebrity/olympic-diver-avid-knitter-tom-daley-looking-for-yarn-shops-in-calgary","image":"https://smartcdn.prod.postmedia.digital/torontosun/wp-content/uploads/2021/08/90331733_212431206668505_6645943834852649896_n-e1628875783369.jpg?quality=100&strip=all","publishedAt":"2021-08-13T07:00:00Z","source":{"name":"Toronto Sun","url":"https://torontosun.com"}}]}
    //var_dump($articles);
    //print_r("total articles: ".$articles->totalArticles);
    //print_r('title:'.$articles->articles[0]->title);
    curl_close($curlcmd);


}
?>

</body>
</html>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/c819ae5683.js" crossorigin="anonymous"></script>

      <!--<link href="css/main.css" rel="stylesheet" />-->
      <script src="js/main.js"></script>
  </head>
  <body>
   <div class="container">
       <header class="py-3">
           <div class="row align-items-center text-center">
               <h2>
                   News reader
               </h2>
           </div>
       </header>
   </div>
   <main class="container">

       <div class="row d-flex justify-content-center">
           <form method="get" class="d-flex flex-column border border-3">
               <div class="p-2 form-floating mb-3">
                   <input type="text" class="form-control" id="keywords" name="keywords">
                   <label for="keywords">keywords for searching</label>
               </div>
               <div>
                   <div class="">ADVANCE SEARCH</div>
                   <div class="p-2 d-md-flex flex-row justify-content-evenly">
                       <div class="form-floating flex-fill">
                           <select class="form-select" id="type" name="type" aria-label="Floating label select example">
                               <option value="search">Search</option>
                               <option value="top-headlines">Top-headlines</option>
                           </select>
                           <label for="type">Type of endpoint</label>
                       </div>
                       <div class="form-floating flex-fill">
                           <select class="form-select" id="language" name="language" aria-label="Floating label select example">
                               <option value="en">English</option>
                               <option value="fr">French</option>
                               <option value="es">Spanish</option>
                               <option value="de">German</option>
                           </select>
                           <label for="language">Language</label>
                       </div>
                       <div class="form-floating flex-fill">
                           <select class="form-select" id="country" name="country" aria-label="Floating label select example">
                               <option value="ca">Canada</option>
                               <option value="us">United States</option>
                               <option value="gb">United Kingdom</option>
                               <option value="au">Australia</option>
                               <option value="de">Germany</option>
                               <option value="es">Spain</option>=
                           </select>
                           <label for="language">Country</label>
                       </div>
                   </div>
                   <div class="p-2 d-md-flex flex-row justify-content-evenly">
                       <div class="form-floating flex-fill">
                           <input type="datetime-local" id="fromDate" name="fromDate" class="form-control" aria-label="Floating label select example">
                           <label for="fromDate">From</label>
                       </div>
                       <div class="form-floating flex-fill">
                           <input type="datetime-local" id="toDate" name="toDate" class="form-control">
                           <label for="toDate">To</label>
                       </div>
                   </div>
                   <div class="d-flex justify-content-end m-3 bd-highlight">
                       <button name="search" class="btn btn-info">Search</button>
                   </div>
               </div>

           </form>
       </div>
       <div id="articles">
           <?php
           echo convertArticleObjectsToBootstrapCards($articles->articles, count($articles->articles));
           //echo convertArticleObjectsToBootstrapCards("afternoon", 1);
           ?>
       </div>
   </main>



  </body>
</html>
