class Posts {

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
                }
                document.getElementById("uPostsAll").innerHTML = html;
            });
    }
}

/*class Register{
    sendRegister(){
        let username = document.getElementById("username").value;
        let email = document.getElementById("email").value;
        let pwd = document.getElementById("password").value;
        let pwdRepeat = document.getElementById("passwordrepeat").value;

        var params = {
            username: username,
            emai: email,
            password: pwd,
            passwordRepeat: pwdRepeat
        }

        fetch("?c=login&a=regUser", {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/x-www-form-urlencoded',
            },
            body: "email=" + email
        })
            .then(response =>response.json())
            .then(response => {
                if(response == "ok"){
                    alert("Moc kratky text. Server");
                    return;
                } else {
                    alert(response);
                    return;
                }
            });
    }
}*/

window.onload = function () {
    var posts = new Posts();
    //var register = new Register();

    if(document.getElementById("btn-load-forum") != null){
        posts.getAllPosts();

        document.getElementById("btn-load-forum").onclick = () => {
            posts.getAllPosts();
        }
    }

    /*if(document.getElementById("btn-register") != null){

        document.getElementById("btn-register").onclick = () => {
            register.sendRegister();
        }
    }*/


}

