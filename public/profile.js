class Posts {

    sendMessage(){
        let text = document.getElementById("text").value;

        if(text.length < 3){
            alert("Moc kratky text.");
            return;
        }

        fetch("?a=addMessage", {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded',
            },
            body: "text=" + text
        })
            .then(response =>response.json())
            .then(response => {
                if(response == "error"){
                    alert("Moc kratky text. Server");
                    return;
                }
            });
    }

    getAllPosts(){
        let url = '?c=forum&a=getAllPosts';
        fetch('?c=forum&a=getAllPosts')
            .then(response => response.json())
            .then(data => {
                let html = "";
                for(let message of data.reverse()){
                    html +=
                        "<div class='main-container'>"
                            +"<div class='left-container'>"
                                + "<img src='InoxiMVC/public/files/" + message.image + "'  class='img-thumbnail img-fluid rounded imgForum'  alt='...' >"
                            +"</div>"
                            +"<div class='right-container'>"
                                + "<h5>" + "<a href='?c=forum&a=profile&0=" + message.username + "'>" + message.username + "</a>" + "</h5>"
                                + "<p>" + message.text +"</p>"
                            +"</div>"
                        +"</div>"
                        /*"<div class='row justify-content-start grid-container' '>"
                            + "<div class='grid-item grid-item-left'>"
                                + "<img src='InoxiMVC/public/files/" + message.image + "'  class='img-thumbnail img-fluid rounded imgForum'  alt='...' >"
                            + "</div>"
                            + "<div class='grid-item'>"
                                + "<h5>" + "<a href='?c=forum&a=profile&0=" + message.username + "'>" + message.username + "</a>" + "</h5>"
                                + "<p>" + message.text +"</p>"
                            + "</div>"
                        + "</div>";*/
                }
                document.getElementById("uPostsAll").innerHTML = html;
            });
    }
}


window.onload = function () {
    var posts = new Posts();

    posts.getAllPosts();

    document.getElementById("btn-load-forum").onclick = () => {
        posts.getAllPosts();
    }

}

