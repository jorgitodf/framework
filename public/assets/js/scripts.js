$(document).ready(function () {

    switch ("{{ uri.getPath() }}") {
        case "/":
            $("#home").attr("class", "active");
            break;
        case "/livros":
            $("#livros").attr("class", "active");
            break;
    }

    $(function () {
        $("#formLogin").submit(function(e) {
            let url = $("#formLogin").attr("action");
            let email = $("#email").val();
            let password = $("#password").val();
            let data = {email: email, password: password};
            e.preventDefault();
            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    console.log(response.data);
                })
                .catch(function(error) {
                    console.log(error);
                })
        });
    });
});   