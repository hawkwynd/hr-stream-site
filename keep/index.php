<?php
/**
 * Keep processing 
 * @version 1.0
 * @author scott fleming
 * 
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require('keep.php');

$keep      = new keep();

// listenersActiveNow
if(isset($_POST['action']) && $_POST['action'] == 'listenersActiveNow')
{
    $response = $keep->listenersActiveNow(); 
    
    echo json_encode( $response );
}

// telegram-bot 
if(isset($_POST['action']) && $_POST['action'] == 'requestCheck')
{
    $response = $keep->telegramCheckRequests( $_POST ); 
    
    echo json_encode( $response );
}



// telegram-bot 
if(isset($_POST['action']) && $_POST['action'] == 'telegram')
{
    $response = $keep->telegramAction( $_POST ); 
    
    echo json_encode( $response );
}



// top10CountryListeners
if(isset($_POST['action']) && $_POST['action'] == 'top10CountryListeners')
{
    $response = $keep->top10CountryListeners(); 
    echo json_encode($response);
}


//  Send post to update play counter for song title
 if( isset($_POST['action']) && $_POST['action'] == 'soapUpdatePlays' )
 {
     $response = $keep->soapUpdatePlays( $_POST );

     echo json_encode($response);
     /** Response
      * {
           "title": "Time In Texas",
            "artist_id": "5533754",
            "release_id": "13521076",
            "plays": "121",
            "id": "17965",
            "last_played": "2022-05-24 17:39:04"
        }
      */
 }

//  Send request action to keep
 if( isset($_POST['action']) && $_POST['action'] == 'request'){
     
       // echo json_encode( $_POST );
       $response = $keep->doRequest( $_POST );

       echo json_encode($response, true );
 }

 if( isset($_POST['action']) && $_POST['action'] == 'artist' ){
     $artist    = $_POST['artist'];    
     $artist    = preg_replace('~\(.*?\)\s?~', '', $artist);
     $discogs_id = $_POST['discogs_id'];
     $inserted  = $keep->insertArtist( $artist, $discogs_id );
     echo $inserted;
}

if( isset($_POST['action']) && $_POST['action'] == 'members') {
     $members       = $_POST['members'];
     $artist_id     = $_POST['artist_id'];
     $inserted      = $keep->insertMembers( $artist_id, $members );   
     echo json_encode($inserted);   
}

if( isset($_POST['action']) && $_POST['action'] == 'profile' ){
    $artist_id = $_POST['artist_id'];
    $excerpt   = $_POST['exceprt'];
    $inserted  = $keep->insertProfile($artist_id, $excerpt);
    echo json_encode($inserted);
}

if( isset($_POST['action']) && $_POST['action'] == 'urls' ){
    $artist_id = $_POST['artist_id'];
    $urls      = $_POST['urls'];
    $inserted  = $keep->insertArtistUrls($artist_id, $urls);
    echo json_encode($inserted);
}

// Do insert of release data
if( isset($_POST['action']) && $_POST['action'] == 'release'){   
    $inserted = $keep->insertRelease( $_POST['data'] ) ;   
    $results = $keep->findRecording( $_POST['data']['recording']['title'] , $_POST['data']['artists'][0]['id'] );
    $results['insertedRelease'] = $inserted;
    echo json_encode( $results );
}

// NERDLY stats 
if(isset($_POST['action']) && $_POST['action'] == 'nerdly') {
    
    $stats = $keep->nerdly();
    echo json_encode($stats);
}

// browse cover images 
if(isset($_POST['action']) && $_POST['action'] == 'browseCovers'){
    $paths = $keep->browseCovers( $_POST['release_id'] );
    echo json_encode($paths, true);
}

// cover image download
if(isset($_POST['action']) && $_POST['action'] == 'cover' ){
    $imagePath = $keep->fetchCover( $_POST );
    echo $imagePath;
}

// query artist/title
if( isset( $_POST['action'] ) && $_POST['action'] == 'lookupAT' ){
    try{
        $results = $keep->browseKeep($_POST['artist'], $_POST['title']);

        if(!$results) throw new Exception( 'browseKeep returned 0 results');

        echo $results;

    }catch( Exception $e){
        return array(
            'error' => $e->getMessage(),
            'func'  => 'browseKeep',
            'line'  => $e->getLine(),
            'file'  => $e->getFile(),
            'POST'  => $_POST
        );
    }

}

// extraartists by release
if( isset( $_POST['action']) && $_POST['action'] == 'extraartists' ){
    try{
        
        $results = $keep->extraArtistByArtist( $_POST['release_id'] );
        echo $results;

    }catch( Exception $e){
        return array(
            'error' => $e->getMessage(),
            'func'  => 'extraartists',
            'line'  => $e->getLine(),
            'file'  => $e->getFile(),
            'POST'  => $_POST
        );
    }
}
