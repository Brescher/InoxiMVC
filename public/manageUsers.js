function getAllUsers(){
    fetch('?c=login&a=getAllUsers')
        .then(response => response.json())
        .then(data => {
            let html = "";
            for(let message of data){
                html +=
                    "<div class='main-container'>"
                    +"  <div class='left-container'>"
                    +"      <p style='text-align: center'>meno: <b>" + message.username + "</b>   | email: <b>" + message.email + "</b>  | status: <b>" + message.userType + "</b></p>"
                    +"  </div>"
                    +"  <div class='right-container'>"
                    +"      <div class='button-container'>"
                    +"          <button onclick='addAdmin("+ message.id +")' type='button' class='btn-add-admin' value='" + message.id + "'>Pridať admina</button>"
                    +"          <button onclick='removeAdmin("+ message.id +")' type='button' class='btn-rm-admin' value='" + message.id + "'>Odobrať admina</button>"
                    +"          <button onclick='deleteUser("+ message.id +")' type='button' class='btn-rm-user' value='" + message.id + "'>Vymazať používateľa</button> "
                    +"      </div>"
                    +"  </div>"
                    +"</div>"
            }
            document.getElementById("uUsersAll").innerHTML = html;
        });
}

function addAdmin(userid){

    if(userid < 0){
        alert("Používateľ neexistuje.");
        return;
    }
    let cont = "?c=login&a=addAdmin&0=";
    let url = cont.concat(userid);
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/x-www-form-urlencoded',
        },
        body: "userid=" + userid
    })
        .then(response =>response.json())
        .then(response => {
            if(response == "error"){
                alert("Moc kratky text. Server");
                return;
            }
        });

    getAllUsers();
}

function removeAdmin(userid){

    if(userid < 0){
        alert("Používateľ neexistuje.");
        return;
    }
    let cont = "?c=login&a=removeAdmin&0=";
    let url = cont.concat(userid);
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/x-www-form-urlencoded',
        },
        body: "userid=" + userid
    })
        .then(response =>response.json())
        .then(response => {
            if(response == "error"){
                alert("Moc kratky text. Server");
                return;
            }
        });

    getAllUsers();
}

function deleteUser(userid){

    if(userid < 0){
        alert("Používateľ neexistuje.");
        return;
    }
    let cont = "?c=login&a=deleteUser&0=";
    let url = cont.concat(userid);
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/x-www-form-urlencoded',
        },
        body: "userid=" + userid
    })
        .then(response =>response.json())
        .then(response => {
            if(response == "error"){
                alert("Moc kratky text. Server");
                return;
            }
        });

    getAllUsers();
}







window.onload = function () {
    let posts = new Posts();

    if(document.getElementById("uUsersAll") != null) {
        getAllUsers();
    }

    if(document.getElementById("btn-load-forum") != null){
        posts.getAllPosts();

        document.getElementById("btn-load-forum").onclick = () => {
            posts.getAllPosts();
        }
    }
}



