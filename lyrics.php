<?php 
    // http://api.chartlyrics.com/apiv1.asmx/SearchLyric?artist=Rush&song=Limelight

    $artist         = urlencode($_POST['artist']);
    $song           = urlencode($_POST['title']);
    $url            = "http://api.chartlyrics.com/apiv1.asmx/SearchLyric?artist=$artist&song=$song";
    $xml            = simplexml_load_file($url);
    $lyricId        = $xml->SearchLyricResult->LyricId;
    $LyricChecksum  = $xml->SearchLyricResult->LyricChecksum;
    $url2           = "http://api.chartlyrics.com/apiv1.asmx/GetLyric?lyricId=".$lyricId."&lyricCheckSum=".$LyricChecksum;
    $xml2           = simplexml_load_file($url2);

    // spew the lyrics

    $arr = explode('\n', $xml2->Lyric );
    $out = "";
    echo nl2br( $xml2->Lyric );
    
    // print_r( $arr );

    // foreach($arr as $line ){
    //     $out .= "<div>" . $line . "</div>";
    // }
    
    // echo $out;

    exit;
    ?>
    
    