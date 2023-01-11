<?php
require_once('include/config.inc.php');

$rnd = substr(md5(uniqid(mt_rand(), true)), 0, 8);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <title><?php echo APPLICATION_NAME; ?> </title>
    <meta name="description" content="Classic Rock 24/7 - Live broadcast every Friday at 7PM CST with your host Scootre!">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    
    
    <!-- telegram css for icon -->
    <link rel="stylesheet" href="https://telegram.org/css/telegram.css?214">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="css/sassy.css?rnd=<?=$rnd;?>" rel="stylesheet" type="text/css"/>

    <!-- bootstrap style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/tessa2.js?rnd=<?=$rnd;?>"></script>
    
    <!-- bootstrap modal js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- LastFM Api -->
    <script type="text/javascript" src="js/lastfm/lastfm.api.md5.js"></script>
    <script type="text/javascript" src="js/lastfm/lastfm.api.js"></script>

    <!-- Google Schema data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "RadioBroadcastService",
        "name": "Hawkwynd Radio",
        "broadCastDisplayName" : "Hawkwynd Radio",
        "callSign": "hawkwyndRadio",
        "url": "http://stream.hawkwynd.com",
        "description" : "Classic Rock Radio serving the world since 2020.",
        "broadcastTimezone": "-5:00",
        "inLanguage": "en"
    }
    </script>

    <?php 
        // Next Friday's date
        $date = new DateTime();
        $date->modify('next friday');
        $startDt = $date->format('Y-m-dT19:00');
        $endDt   = $date->format('Y-m-dT21:00')
    ?>
    <!-- Friday Night Live Schema.org jd+json -->
    <script type="application/ld+json">
        {
        "@context":"https://schema.org",
        "@type":"BroadcastEvent",
        "startDate":"<?php echo $startDt;?>",
        "endDate":"<?php echo $endDt; ?>",
        "publishedOn":{
            "@type":"BroadcastService",
            "name": "Friday Night Live!"
        },
        "workPerformed":{
            "@type":"CreativeWork",
            "name": "Friday Night Live! with host Scootre"
        },
        "inLanguage":"en",
        "isLiveBroadcast":true,
        "name":"Hawkwynd Radio Friday Night Live!",
        "description":"Scott takes your requests and runs the theme for the evening's show.",
        "url":"http://stream.hawkwynd.com"
        }
</script>

<!-- google analytics  G-P3Y1KMLDSM -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-P3Y1KMLDSM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-P3Y1KMLDSM');
</script>

</head>
<body>

<div class="main-container">
    <div id="wb_MediaPlayer1">
            <div class="stream-details">
                <div class="app-title" aria-label="title">                  
                    <?php printf('<div class="appName">%s %s</div>', APPLICATION_NAME ,'<span class="nerdlyContainer no-mobile">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#statsModal">Stats</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#telegramModal">Connect</button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#lyricModal">Lyrics</button>
                    </span>' ); ?><div class="timebox"></div>
                </div>
                
                <div class="app-motd" aria-label="motd"></div>

                <div class="nowplaying-title">
                    <span class="animate-flicker">Initializing Tesseract</span>
                </div>
                <div class="nowplaying">

                <div class="loading">
                    <div class="sk-folding-cube">
                        <div class="sk-cube1 sk-cube"></div>
                        <div class="sk-cube2 sk-cube"></div>
                        <div class="sk-cube4 sk-cube"></div>
                        <div class="sk-cube3 sk-cube"></div>
                    </div>
                </div>

                    <div class="thumb-container"><img data-toggle="modal" data-target="#imgModal" >                   
                    <div class="song-album"></div>
                    <div class="year-label"></div>
                
                    </div>

                    <div class="current-song-container">
                        <div class="artist-name"></div>
                        <div class="song-title"></div>
                        
                        <div class="artist-rels">
                            <div class="active-members"></div>
                            <div class="inactive-members"></div>
                        </div>
                    </div>
                    <div class="recording-list-container"></div>
                </div><!-- .now-playing -->
            </div>

        <div class="audioContainer">
            <audio src="<?php echo SHOUTCAST_HOST.'/;';?>" id="MediaPlayer1" controls="controls"></audio>
        </div>

    </div>
    <div class="statistics">
            <div class="totalRecs">Powered by Tesseract v2</div>
            <div class="nerdystats"></div>
            <div class="uptime"></div>
            <div class="listeners"></div>
    </div>
  <div class="metaContainer">
    <div class="content-container">
        <div class="tempContainer"></div>
        <div id="artist-wiki"></div>
        <div class="wrap-collapsible-history"></div>              
    </div>
    <div class="lowerContainer">
        <div class="wrap-collapsible-releases"></div>       
        <div class="wrap-collapsible-about-releases"></div>
    </div>        
   </div><!-- .metaContainer -->
 
</div><!-- main-container -->




<!-- Stats Modal -->
<div class="modal fade" id="statsModal" tabindex="-1" role="dialog" aria-labelledby="statsModallLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="statsModalLabel">Hawkwynd Radio Nerdly Statistics</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
            <div class="nerdly"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>

<!-- Image Carosel Modal -->
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="imgModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body text-center">
        
          <div id="carouselKeep" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner"></div>

          <a class="carousel-control-prev" href="#carouselKeep" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselKeep" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
          </a>
      </div><!--//carouselKeep -->
    </div><!--//modal-body -->
      
      <div id="attribute" class="text-center"></div>
      <div id="genres" class="text-center"></div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>

<!-- ExtraArtist Modal -->
<div class="modal fade" id="EAModal" tabindex="-1" role="dialog" aria-labelledby="statsModallLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="statsModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="nerdly"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>
<!-- Telegram Modal -->
<div class="modal fade" id="telegramModal">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="telegramModalLabel">Join the Hawkwynd Radio Group on Telegram!</h5>
      </div>
      <div class="modal-body">
        <div>
          <div class="row mb-2">Share your requests, and talk about the music, and stay up to date with events and programming changes. We love to hear your feedback, and welcome your comments.</div>
            <div class="row mt-2 mb-2">
                <a target="_blank" href="https://t.me/hawkwyndRadio">
                  <svg class="tgme_logo" height="34" viewBox="0 0 133 34" width="133" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd">
                      <circle cx="17" cy="17" fill="var(--accent-btn-color)" r="17"></circle><path d="m7.06510669 16.9258959c5.22739451-2.1065178 8.71314291-3.4952633 10.45724521-4.1662364 4.9797665-1.9157646 6.0145193-2.2485535 6.6889567-2.2595423.1483363-.0024169.480005.0315855.6948461.192827.1814076.1361492.23132.3200675.2552048.4491519.0238847.1290844.0536269.4231419.0299841.65291-.2698553 2.6225356-1.4375148 8.986738-2.0315537 11.9240228-.2513602 1.2428753-.7499132 1.5088847-1.2290685 1.5496672-1.0413153.0886298-1.8284257-.4857912-2.8369905-1.0972863-1.5782048-.9568691-2.5327083-1.3984317-4.0646293-2.3321592-1.7703998-1.0790837-.212559-1.583655.7963867-2.5529189.2640459-.2536609 4.7753906-4.3097041 4.755976-4.431706-.0070494-.0442984-.1409018-.481649-.2457499-.5678447-.104848-.0861957-.2595946-.0567202-.3712641-.033278-.1582881.0332286-2.6794907 1.5745492-7.5636077 4.6239616-.715635.4545193-1.3638349.6759763-1.9445998.6643712-.64024672-.0127938-1.87182452-.334829-2.78737602-.6100966-1.12296117-.3376271-1.53748501-.4966332-1.45976769-1.0700283.04048-.2986597.32581586-.610598.8560076-.935815z" fill="#fff"></path><path d="m49.4 24v-12.562h-4.224v-2.266h11.198v2.266h-4.268v12.562zm16.094-4.598h-7.172c.066 1.936 1.562 2.772 3.3 2.772 1.254 0 2.134-.198 2.97-.484l.396 1.848c-.924.396-2.2.682-3.74.682-3.476 0-5.522-2.134-5.522-5.412 0-2.97 1.804-5.764 5.236-5.764 3.476 0 4.62 2.86 4.62 5.214 0 .506-.044.902-.088 1.144zm-7.172-1.892h4.708c.022-.99-.418-2.618-2.222-2.618-1.672 0-2.376 1.518-2.486 2.618zm9.538 6.49v-15.62h2.706v15.62zm14.84-4.598h-7.172c.066 1.936 1.562 2.772 3.3 2.772 1.254 0 2.134-.198 2.97-.484l.396 1.848c-.924.396-2.2.682-3.74.682-3.476 0-5.522-2.134-5.522-5.412 0-2.97 1.804-5.764 5.236-5.764 3.476 0 4.62 2.86 4.62 5.214 0 .506-.044.902-.088 1.144zm-7.172-1.892h4.708c.022-.99-.418-2.618-2.222-2.618-1.672 0-2.376 1.518-2.486 2.618zm19.24-1.144v6.072c0 2.244-.462 3.85-1.584 4.862-1.1.99-2.662 1.298-4.136 1.298-1.364 0-2.816-.308-3.74-.858l.594-2.046c.682.396 1.826.814 3.124.814 1.76 0 3.08-.924 3.08-3.234v-.924h-.044c-.616.946-1.694 1.584-3.124 1.584-2.662 0-4.554-2.2-4.554-5.236 0-3.52 2.288-5.654 4.862-5.654 1.65 0 2.596.792 3.102 1.672h.044l.11-1.43h2.354c-.044.726-.088 1.606-.088 3.08zm-2.706 2.948v-1.738c0-.264-.022-.506-.088-.726-.286-.99-1.056-1.738-2.2-1.738-1.518 0-2.64 1.32-2.64 3.498 0 1.826.924 3.3 2.618 3.3 1.012 0 1.892-.66 2.2-1.65.088-.264.11-.638.11-.946zm5.622 4.686v-7.26c0-1.452-.022-2.508-.088-3.454h2.332l.11 2.024h.066c.528-1.496 1.782-2.266 2.948-2.266.264 0 .418.022.638.066v2.53c-.242-.044-.484-.066-.814-.066-1.276 0-2.178.814-2.42 2.046-.044.242-.066.528-.066.814v5.566zm16.05-6.424v3.85c0 .968.044 1.914.176 2.574h-2.442l-.198-1.188h-.066c-.638.836-1.76 1.43-3.168 1.43-2.156 0-3.366-1.562-3.366-3.19 0-2.684 2.398-4.07 6.358-4.048v-.176c0-.704-.286-1.87-2.178-1.87-1.056 0-2.156.33-2.882.792l-.528-1.76c.792-.484 2.178-.946 3.872-.946 3.432 0 4.422 2.178 4.422 4.532zm-2.64 2.662v-1.474c-1.914-.022-3.74.374-3.74 2.002 0 1.056.682 1.54 1.54 1.54 1.1 0 1.87-.704 2.134-1.474.066-.198.066-.396.066-.594zm5.6 3.762v-7.524c0-1.232-.044-2.266-.088-3.19h2.31l.132 1.584h.066c.506-.836 1.474-1.826 3.3-1.826 1.408 0 2.508.792 2.97 1.98h.044c.374-.594.814-1.034 1.298-1.342.616-.418 1.298-.638 2.2-.638 1.76 0 3.564 1.21 3.564 4.642v6.314h-2.64v-5.918c0-1.782-.616-2.838-1.914-2.838-.924 0-1.606.66-1.892 1.43-.088.242-.132.594-.132.902v6.424h-2.64v-6.204c0-1.496-.594-2.552-1.848-2.552-1.012 0-1.694.792-1.958 1.518-.088.286-.132.594-.132.902v6.336z" fill="var(--tme-logo-color)" fill-rule="nonzero"></path>
                    </g>
                  </svg>
                  </div>
                <div> https://t.me/hawkwyndRadio</div>
              </a> 
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      
      </div>
    </div>
  </div>
</div>

<!-- Lyrics Modal -->
<div class="modal fade" id="lyricModal">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="lyricModalLabel"></h5>
      </div>
      <div class="modal-body">
            <div class="row mt-2 mb-2 lyric-modal-container"></div>
            <div class="lyrics"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>        
      
      </div>
    </div>
  </div>
</div>

</body>
</html>
