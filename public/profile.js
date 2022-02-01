class Chat {

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

    getAllMessages(){
        let parameters = new URLSearchParams(window.location.search);
        let username = parameters.get("username");
        let url = '?c=forum&a=getUserPost&username=';
        let result = url.concat(username);
        fetch(result)
            .then(response => response.json())
            .then(data => {
                let html = "";
                for(let message of data.reverse()){
                    html += "<div className= 'card' style= 'width: 18rem; margin: 5px'>"

                                + "<img src='InoxiMVC/public/files/" + message.image + "' className='card-img-top' alt='...' width='100%'>"
                                    + "<div className='card-body'>"
                                        + "<h5 className='card-title'>" + message.username + "</h5>"
                                        + "<p className='card-text'>" + message.text +"</p>"
                                    + "</div>"
                            + "</div>";
                }
                document.getElementById("uPosts").innerHTML = html;
            });
    }

    getAllMessagesF(){
        let url = '?c=forum&a=getAllPosts';
        fetch(url)
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

    startMessageReloading(){
        setInterval( ()=>{
            this.getAllMessages();
        }, 1000)
    }
}


window.onload = function () {
    var chat = new Chat();

    chat.getAllMessages();
    chat.getAllMessagesF();

    document.getElementById("btn-odoslat").onclick = () => {
        chat.getAllMessages();
    }
    document.getElementById("btn-odoslat-f").onclick = () => {
        chat.getAllMessagesF();
    }
}

