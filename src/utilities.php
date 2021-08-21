<?php
function convertArticleObjectsToBootstrapCards($articles,$count){
    $htmlText = '<div class="row row-cols-sm-1 row-cols-md-3 g-4">';
    for($i =0; $i<$count;$i++){
        $htmlText .= '<div class="col">';
        $htmlText .='<div class="card text-center mx-auto" style="width: 18rem;">';
        $htmlText .='<img src="'.$articles[$i]->image.'" class="card-img-top" alt="...">';
        $htmlText .= '<div class="card-body">';
        $htmlText .= '<p class="card-title">'.$articles[$i]->title.'</p>';
        $htmlText .= '<div class="d-flex flex-row align-items-center">';
        $htmlText .= '<a href="'.$articles[$i]->url.'" class="btn btn-primary flex-fill">Link</a>';
        $htmlText .= '<a href="audio-query.php?text='.$articles[$i]->title.'" id="title'.$i.'" onclick="return readTitle(this);" class="flex-fill"><i class="fas fa-volume-up"></i></a>';
        $htmlText .= '</div>';
        $htmlText .= '</div></div></div>';
    }

    $htmlText .= '</div>';
    return $htmlText;
}





  
    
    
