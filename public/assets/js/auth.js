if (localStorage.getItem("token") !== null) {
    location = "/dashboard";
}
// localStorage.clear();
// console.log(localStorage.getItem('token'));
if (location.pathname == "/login") {
    $("#login-form").on("submit", function () {
        login();
        async function login() {
            try {
                const response = await axios.post("api/admin/login", {
                    email: $("#inputEmail").val(),
                    password: $("#inputPassword").val(),
                });

                if (response.status === 200) {
                    localStorage.clear();
                    localStorage.setItem("id", response.data.data.id);
                    localStorage.setItem("name", response.data.data.name);
                    localStorage.setItem("token", response.data.data.token);

                    window.location = "/dashboard";
                }
            } catch (error) {}
        }
    });
}
