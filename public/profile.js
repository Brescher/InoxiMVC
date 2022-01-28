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
        fetch('?a=getAllMessages')
            .then(response => response.json())
            .then(data => {
                let html = "";
                for(let message of data){
                    html += "<div>" + message.message + "</div>";
                }
                document.getElementById("chatbox").innerHTML = html;
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
    chat.startMessageReloading();

    document.getElementById("btn-odoslat").onclick = () => {
        chat.sendMessage();
    }
}