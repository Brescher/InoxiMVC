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







