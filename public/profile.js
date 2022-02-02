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
                    html += "<div className='card' style='width: 18rem; margin: 5px'>"
                            + "<img src='InoxiMVC/public/files/" + message.image + "' className='card-img-top' alt='...' width='100%'>"
                                + "<div className='card-body'>"
                                    + "<h5 className='card-title'>" + message.username + "</h5>"
                                    + "<p className='card-text'>" + message.text +"</p>"
                                + "</div>"
                            + "</div>";
                }
                document.getElementById("uPostsAll").innerHTML = html;
            });
    }
}


window.onload = function () {
    var chat = new Posts();

    chat.getAllPosts();

    document.getElementById("btn-load-forum").onclick = () => {
        chat.getAllPosts();
    }

}

