function readTitle(element) {
    console.log("id = "+element.id);
    console.log("content = "+element.content);
    console.log("href = "+element.href);
    const param = element.href.substring(element.href.indexOf('?'));
    console.log("title = "+param);
    const xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200){
            console.log("responseText:"+this.responseText);
            const speech = new Audio("../src/"+this.responseText);
            speech.play();

        }
    }

    const url = 'src/audio-query.php'+param;
    console.log('url = '+url);
    xmlHttpRequest.open("GET",url);
    xmlHttpRequest.send();
    return false;
}

