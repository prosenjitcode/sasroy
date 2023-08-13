function authorized() {
    if (localStorage.getItem("token") === null) {
        window.location = "/login";
    } else {
        axios.interceptors.request.use(function (config) {
            const token = "Bearer " + localStorage.getItem("token");
            config.headers.Authorization = token;

            return config;
        });
    }
}

$("#logout").on("click", function () {
    logout();
});
async function logout() {
    try {
        const response = await axios.post("api/admin/logout");

        localStorage.clear();
        window.location = "/login";
    } catch (error) {
        if (error.response.status === 401) {
            localStorage.clear();
            window.location = "/login";
        }
    }
}

if (window.location.pathname == "/dashboard") {
    authorized();
}
//Banner Fucntion....
if (window.location.pathname == "/banners") {
    authorized();
    loadBanner();
    async function loadBanner() {
        try {
            const response = await axios.get("api/banners");
            banner_table_data(response.data.data);
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    }

    function banner_table_data(data) {
        var row = "";

        $.each(data, function (key, value) {
            key += 1;
            row =
                row +
                `<tr>
            <td>${key}</td>
        <td>${value.title}</td>
        <td><img src="${value.image_url}" style="width:50px;" alt="img"></td>
        <td><button onclick="openBannerModal(${value.id})" class="btn btn-success btn-sm float-start"><i class="fas fa-pencil fa-fw"></i></button>
        <form">
        <button name="banner-delete" onclick="deleteBanner(${value.id})" class="btn btn-danger btn-sm mx-2"><i class="fas fa-trash fa-fw"></i></button>
        </form> </td>

        </tr>`;
        });
        // console.log(row)

        $("#tdata").html(row);
    }

    function bannerModalClose() {
        $("#bannerModal").modal("hide");
    }

    function openBannerModal(params) {
        getBanner();
        async function getBanner() {
            try {
                const response = await axios.get("api/banners/" + params);
                $("#banner-id").val(response.data.data.id);
                $("#banner-name").val(response.data.data.title);
                $("#bannerModal").modal("show");
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
    }

    function deleteBanner(params) {
        distroy();
        async function distroy() {
            try {
                const response = await axios.delete("api/admin/banner/" + params);
                swal({title:"Banner", text:"Deleted",  timer: 2000});
                loadBanner();
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
    }

    $("#banner-view-form").on("submit", async function (e) {
        e.preventDefault();
        let id = $("#banner-id").val();
        let name = $("#banner-name").val();
        let imageUrl = document.getElementById("banner-img").files[0];

        let data = new FormData();

        data.append("title", name);
        data.append("image_url", imageUrl ?? "");

        try {
            const response = await axios.post("api/admin/banner/" + id, data);
            $("#bannerModal").modal("hide");
            swal("Good job!", "Updated", "success");
            loadBanner();
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    });

    $("#banner-add-form").on("submit", async function (e) {
        let name = $("#add-banner-title").val();
        let imageUrl = document.getElementById("add-banner-img").files[0];

        let data = new FormData();

        data.append("title", name);
        data.append("image_url", imageUrl ?? "");

        try {
            const response = await axios.post("api/admin/banner", data);
            swal("Successfully created", "", "success");
            loadBanner();
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    });
}
//Category Fucntion....
if (window.location.pathname == "/categories") {
    authorized();
    loadCategory();
    async function loadCategory() {
        try {
            const response = await axios.get("api/categories");
            category_table_data(response.data.data);
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    }

    function category_table_data(data) {
        var row = "";

        $.each(data, function (key, value) {
            key += 1;
            row =
                row +
                `<tr>
            <td>${key}</td>
        <td>${value.name}</td>
        <td>${value.totalProduct}</td>
        <td><img src="${value.imageUrl}" style="width:50px;" alt="img"></td>
        <td><button onclick="openCatModal(${value.id})" class="btn btn-success btn-sm float-start"><i class="fas fa-pencil fa-fw"></i></button>
        <form">
        <button name="category-delete" value="" class="btn btn-danger btn-sm mx-2"><i class="fas fa-trash fa-fw"></i></button>
        </form> </td>

        </tr>`;
        });
        // console.log(row)

        $("#tdata").html(row);
    }

    function categoryModalClose() {
        $("#categoryProductModal").modal("hide");
    }

    function openCatModal(params) {
        getCat();
        async function getCat() {
            try {
                const response = await axios.get("api/categories/" + params);
                $("#cat-id").val(response.data.data.id);
                $("#cat-name").val(response.data.data.name);
                $("#categoryProductModal").modal("show");
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
    }

    $("#category-view-form").on("submit", async function (e) {
        e.preventDefault();
        let id = $("#cat-id").val();
        let name = $("#cat-name").val();
        let imageUrl = document.getElementById("cat-img").files[0];

        let data = new FormData();

        data.append("name", name);
        data.append("imageUrl", imageUrl ?? "");

        try {
            const response = await axios.post("api/admin/category/" + id, data);
            $("#categoryProductModal").modal("hide");
            swal("Good job!", "Updated", "success");
            loadCategory();
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    });

    $("#category-add-form").on("submit", async function (e) {
        let name = $("#add-cat-name").val();
        let imageUrl = document.getElementById("add-cat-img").files[0];

        let data = new FormData();

        data.append("name", name);
        data.append("imageUrl", imageUrl ?? "");

        try {
            const response = await axios.post("api/admin/category", data);
            swal("Successfully created", "", "success");
            loadCategory();
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    });
}

if (window.location.pathname == "/products") {
    authorized();

    loadProduct(1);

    function loadProduct(params) {
        axios
            .get("api/products?page=" + params)
            .then(function (response) {
                table_data(response.data);
                //console.log(response.data);
            })
            .catch(function (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            });
    }

    function table_data(data) {
        var row = "";
        var page = "";
        var ls = data.meta.from;

        //console.log(ls);

        $.each(data.meta.links, function (key, value) {
            //console.log(value.label);
            if (value.active) {
                page =
                    page +
                    ' <li class="page-item active"><button onclick="reload(' +
                    value.label +
                    ')" id="' +
                    value.label +
                    '" class="page-link" >' +
                    value.label +
                    '<span class="sr-only">(current)</span></button></li>';
            } else {
                page =
                    page +
                    ' <li class="page-item"><button onclick="reload(' +
                    value.label +
                    ')" id="' +
                    value.label +
                    '" class="page-link">' +
                    value.label +
                    "</button></li>";
            }
        });
        $("ul").html(page);
        $.each(data.data, function (key, value) {
            key += ls;

            row =
                row +
                `<tr>
                <td>  ${key} </td>
                <td>${value.title}</td>
                <td> ${value.category}</td>
                <td>${value.autor} </td>
                <td><img src="${value.imageUrl}" style="width:50px;" alt="img"></td>
                <td>Rs. ${value.price} </td>
                <td><button onclick="loadById(${value.id})" class="btn btn-primary btn-sm float-start mx-2"><i class="fas fa-eye fa-fw"></i></button>
                <button name="category-delete" value="" class="btn btn-danger btn-sm mx-2"><i class="fas fa-trash fa-fw"></i></button></td></tr>`;
        });

        $("#product-table").html(row);
    }

    function reload(id) {
        loadProduct(id);
    }

    function categories(id) {
        var option = "";
        axios
            .get("api/categories/")
            .then(function (response) {
                $.each(response.data.data, function (key, item) {
                    if (id == item.id) {
                        option =
                            option +
                            `<option selected value="${item.id}">${item.name}</option>`;
                    } else {
                        option =
                            option +
                            `<option value="${item.id}">${item.name}</option>`;
                    }
                });

                $("select[name~='cat-id']").html(option);
            })
            .catch(function (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            });
    }
    function loadById(params) {
        getItem();
        async function getItem() {
            try {
                const response = await axios.get(
                    "api/admin/products/" + params
                );
                categories(response.data.data.categoryId);
                $("#exampleModal").modal("show");
                $("input[name~='id']").val(response.data.data.id);
                $("input[name~='name']").val(response.data.data.title);
                $("input[name~='author']").val(response.data.data.autor);
                $("input[name~='price']").val(response.data.data.price);
                $("input[name~='pages']").val(response.data.data.pages);
                $("input[name~='discount']").val(response.data.data.discount);
                $("option[name~='cate']").text(response.data.data.category);
                $("textarea[name~='description']").text(
                    response.data.data.description
                );
                $("input[name~='pdate']").val(response.data.data.publishDate);
                $("input[name~='language']").val(response.data.data.language);
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
    }

    function modalClose() {
        $("#exampleModal").modal("hide");
    }

    function AddModalClose(params) {
        $("#addProductModal").modal("hide");
    }

    $("#view-form").on("submit", async function (event) {
        event.preventDefault();
        let name = $("input[name~='name']").val();
        let author = $("input[name~='author']").val();
        let price = $("input[name~='price']").val();
        let pages = $("input[name~='pages']").val();
        let dicount = $("input[name~='discount']").val();
        let catId = $("select[name~='cat-id']").val();
        let description = $("textarea[name~='description']").val();
        let pDate = $("input[name~='pdate']").val();
        let language = $("input[name~='language']").val();
        let id = $("input[name~='id']").val();
        let imageUrl = document.getElementById("img").files[0];

        let data = new FormData();
        data.append("category_id", catId);
        data.append("title", name);
        data.append("autor", author);
        data.append("publishDate", pDate);
        data.append("description", description);
        data.append("price", price);
        data.append("discount", dicount);
        data.append("pages", pages);
        data.append("language", language);
        data.append("imageUrl", imageUrl ?? "");

        try {
            const response = await axios.post("api/admin/product/" + id, data);
            swal("Good job!", "Updated", "success");
            $("#exampleModal").modal("hide");
            loadProduct(1);
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    });

    function addcategories() {
        var option = "";
        axios
            .get("api/categories/")
            .then(function (response) {
                $.each(response.data.data, function (key, item) {
                    option =
                        option +
                        `<option value="${item.id}">${item.name}</option>`;
                });

                $("select[name~='cat-id4']").html(option);
            })
            .catch(function (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            });
    }

    $("#AddProduct").on("click", function (e) {
        e.preventDefault();
        addcategories();
        $("#addProductModal").modal("show");
    });

    $("#add-form").on("submit", async function (event) {
        event.preventDefault();
        var name = $("input[name~='name1']").val();
        var author = $("input[name~='author2']").val();
        var language = $("input[name~='language3']").val();
        var catId = $("select[name~='cat-id4']").val();
        var price = $("input[name~='price5']").val();
        var pDate = $("input[name~='pdate6']").val();
        var pages = $("input[name~='pages7']").val();
        var dicount = $("input[name~='discount8']").val();
        var description = $("textarea[name~='description9']").val();
        var imageUrl = document.getElementById("addimg").files[0];

        let data = new FormData();
        data.append("category_id", catId);
        data.append("title", name);
        data.append("autor", author);
        data.append("publishDate", pDate);
        data.append("description", description);
        data.append("price", price);
        data.append("discount", dicount);
        data.append("pages", pages);
        data.append("language", language);
        data.append("imageUrl", imageUrl);

        try {
            const response = await axios.post("api/admin/products", data);

            $("#addProductModal").modal("hide");
            swal("Done!", "Item create successfull.", "success");
            loadProduct(1);
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    });
}
//Order...
if (window.location.pathname == "/orders") {
    authorized();
    getPayments();
    async function getPayments() {
        try {
            const response = await axios.get("api/admin/payments");

            order_tabe(response.data.data);
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    }

    function order_tabe(params) {
        var td = "";
        $.each(params, function (key, item) {
            key += 1;
            // console.log(item.user);
            const d = new Date(item.orderDate);
            td =
                td +
                `<tr><td>${key}</td>
            <td>${item.user.name}</td>
            <td>${item.item.title}</td>
            <td>${item.orderDate}</td>
            <td>${item.payment}</td>
            <td><button ${
                item.status === "delivered" ? "disabled" : ""
            } onclick="updateStatus('${item.status}',${
                    item.id
                })" class="btn btn-outline-success btn-sm float-start mx-2">
            ${
                item.status === "ordered"
                    ? "Order confirmed"
                    : item.status === "packed"
                    ? "Packed"
                    : item.status === "shipped"
                    ? "Shipped"
                    : item.status === "delivered"
                    ? "Delivered"
                    : ""
            }
            </button>
            </td>
            <td><button onclick="loadOrder(${
                item.id
            })"class="btn btn-primary btn-sm float-start mx-2"><i class="fas fa-eye fa-fw"></i></button>
             </td>
            </tr>`;
        });

        $("#orders-table").html(td);
    }

    function updateStatus(status, id) {
        orderUpdate();
        async function orderUpdate() {
            try {
                await axios.post(
                    "api/admin/payments/" + id + "/update-status",
                    {
                        status: status,
                    }
                );
                getPayments();
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
    }
    function orderModalClose() {
        $("#orderModal").modal("hide");
    }

    function loadOrder(id) {
        let orderData;
        getOrder();
        async function getOrder() {
            try {
                const response = await axios.get("api/admin/payments/" + id);
                orderData = response.data;

                if (
                    orderData.data.razorpay_order_id !== "null" &&
                    orderData.data.payment === "Online"
                ) {
                   
                    order(orderData);
                } else {
                    load_contentt(orderData);
                }
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
        let payment;
        async function order(params) {
            let data = new FormData();
            data.append("order_id", params.data.razorpay_order_id);
            try {
                const orderResponse = await axios.post(
                    "api/admin/payments/order",
                    data
                );
                payment = orderResponse.data.order;
                //console.log(payment)
                load_content(orderData.data, payment);
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }

        function load_content(orderData, payment) {
            let row = `<div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header">
                        Buyer
                    </div>
                    <div class="card-body">
                        <h5>Name: ${orderData.user.name}</h5>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-2">   
                    <div class="card-header">
                        Deliver to
                    </div>
                   

                    <div class="card-body">
                        <h5>Name: ${orderData.address.name}</h5>
                        <p> ${orderData.address.name}</p>
                        <p> ${orderData.address.address}</p>
                        <p> ${orderData.address.city}</p>
                        <p> ${orderData.address.area}</p>
                        <p> ${orderData.address.pincode}</p>
                        <p> ${orderData.address.state}</p>
                        <p>Phone: ${orderData.address.phoneNo}</p>
    
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header">
                        Order Details
                    </div>
                    <div class="card-body">
                        <p>Order Id: ${payment.id}</p>
                        <p>Amount: Rs.${payment.amount / 100}</p>
                        <p>Amount paid: Rs.${payment.amount_paid / 100}</p>
                        <p>Amount due: ${payment.amount_due}</p>
                        <p>Currency: ${payment.currency}</p>
                        <p>Status: ${payment.status}</p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-header">
                        Prodact details
                    </div>
                    <div class="card-body">
                        <h5>Quantity: ${orderData.qty}</h5>
                        <p>Item Name: ${orderData.item.title}</p>
                        <p>Author: ${orderData.item.autor}</p>
                        <p>Language: ${orderData.item.language}</p>
                        <p>Description: ${orderData.item.description}</p>
                        <p>Pages: ${orderData.item.pages}</p>
                        <p>Total price: Rs.${orderData.totalPrice}</p>
                        <p>Payment: ${orderData.payment}</p>
                        <p>Status: ${orderData.status}</p>
                        <p>Order Date: ${orderData.orderDate}</p>
                        <p>Package Date: ${orderData.packDate}</p>
                        <p>Shipping Date: ${orderData.shippingDate}</p>
    
                    </div>
                </div>
            </div>
        </div>`;
            $("#order-details").html(row);
            $("#orderModal").modal("show");
        }
    }

    function load_contentt(orderData) {
        let row = `<div class="row">
        <div class="col-6">
            <div class="card mb-2">
                <div class="card-header">
                    Buyer
                </div>
                <div class="card-body">
                    <h5>Name: ${orderData.data.user.name}</h5>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-2">   
                <div class="card-header">
                    Deliver to
                </div>
               

                <div class="card-body">
                    <h5>Name: ${orderData.data.address.name}</h5>
                    <p> ${orderData.data.address.name}</p>
                    <p> ${orderData.data.address.address}</p>
                    <p> ${orderData.data.address.city}</p>
                    <p> ${orderData.data.address.area}</p>
                    <p> ${orderData.data.address.pincode}</p>
                    <p> ${orderData.data.address.state}</p>
                    <p>Phone: ${orderData.data.address.phoneNo}</p>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col">
            <div class="card mb-2">
                <div class="card-header">
                    Prodact details
                </div>
                <div class="card-body">
                    <h5>Quantity: ${orderData.data.qty}</h5>
                    <h5>Order Id: ${orderData.data.razorpay_order_id}</h5>
                    <p>Item Name: ${orderData.data.item.title}</p>
                    <p>Author: ${orderData.data.item.autor}</p>
                    <p>Language: ${orderData.data.item.language}</p>
                    <p>Description: ${orderData.data.item.description}</p>
                    <p>Pages: ${orderData.data.item.pages}</p>
                    <p>Total price: Rs.${orderData.data.totalPrice}</p>
                    <p>Payment: ${orderData.data.payment}</p>
                    <p>Status: ${orderData.data.status}</p>
                    <p>Order Date: ${orderData.data.orderDate}</p>
                    <p>Package Date: ${orderData.data.packDate}</p>
                    <p>Shipping Date: ${orderData.data.shippingDate}</p>

                </div>
            </div>
        </div>
    </div>`;
        $("#order-details").html(row);
        $("#orderModal").modal("show");
    }
}
if (window.location.pathname == "/users") {
    authorized();

    loadusers();

    async function loadusers() {
        try {
            const response = await axios.get("api/admin/users");
            user_table(response.data);
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    }

    function user_table(params) {
        var row = "";
        var page = "";
        var ls = params.meta.from;

        //console.log(ls);

        $.each(params.meta.links, function (key, value) {
            //console.log(value.label);
            if (value.active) {
                page =
                    page +
                    ' <li class="page-item active"><button onclick="reload(' +
                    value.label +
                    ')" id="' +
                    value.label +
                    '" class="page-link" >' +
                    value.label +
                    '<span class="sr-only">(current)</span></button></li>';
            } else {
                page =
                    page +
                    ' <li class="page-item"><button onclick="reload(' +
                    value.label +
                    ')" id="' +
                    value.label +
                    '" class="page-link">' +
                    value.label +
                    "</button></li>";
            }
        });
        $("#page-ul").html(page);
        $.each(params.data, function (index, user) {
            index += 1;
            row += `<tr>
           <td>${index}</td>
           <td>${user.name}</td>
           <td>${user.email}</td>
           <td>Action</td>
           </tr>
           `;
        });

        $("#user-table").html(row);
    }
}

if (window.location.pathname == "/payment-gateway") {
    authorized();
    let id;
    getPG();
    async function getPG() {
        try {
            const response = await axios.get("api/admin/payments-gateway");

            if (response.data.data === null) {
                axios
                    .post("api/admin/payments-gateway", {
                        razorpay_key_id: "XXXXX5465X",
                        razorpay_secret_id: "155eeXXXXX",
                    })
                    .then(function (res) {
                        if (res.data.message) {
                            getPG();
                        }
                    });
            } else {
                //console.log(response.data.data);
                id = response.data.data.id;
                $("#key-id").val(response.data.data.razorpay_key_id);
                $("#key-secret").val(response.data.data.razorpay_secret_id);
            }
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    }
    $("#pg-form").on("submit", function () {
        updatePG();
        async function updatePG() {
            try {
                const response = await axios.post(
                    "api/admin/payments-gateway/" + id,
                    {
                        razorpay_key_id: $("#key-id").val(),
                        razorpay_secret_id: $("#key-secret").val(),
                    }
                );

                if (response.data.message) {
                    swal("Done!", "", "success");
                    getPG();
                }
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
    });
}

if (window.location.pathname == "/privacy") {
    authorized();
    let id;
    getPr();
    async function getPr() {
        try {
            const response = await axios.get("api/admin/privacy");

            if (response.data === null) {
                axios
                    .post("api/admin/privacy", {
                        privacy: "Write Your privacy.",
                    })
                    .then(function (res) {
                        if (res.data.message) {
                            getPr();
                        }
                    });
            } else {
                id = response.data.id;
                tinymce.get("message").setContent(`${response.data.privacy}`);
            }
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    }
    $("#privacy_form").on("submit", function () {
        updatePr();
        async function updatePr() {
            try {
                const response = await axios.post("api/admin/privacy/" + id, {
                    privacy: $("#message").val(),
                });

                if (response.data.message) {
                    swal("Done!", "", "success");
                    getPr();
                }
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
    });
}

if (window.location.pathname == "/term") {
    authorized();
    let id;
    getTerm();
    async function getTerm() {
        try {
            const response = await axios.get("api/admin/term");

            if (response.data === null) {
                axios
                    .post("api/admin/term", {
                        term: "Write Your term.",
                    })
                    .then(function (res) {
                        if (res.data.message) {
                            getTerm();
                        }
                    });
            } else {
                id = response.data.id;
                tinymce.get("message").setContent(`${response.data.term}`);
            }
        } catch (error) {
            if (error.response.status === 401) {
                window.location = "/login";
            }
        }
    }
    $("#term_form").on("submit", function () {
        updateTerm();
        async function updateTerm() {
            try {
                const response = await axios.post("api/admin/term/" + id, {
                    term: $("#message").val(),
                });

                if (response.data.message) {
                    swal("Done!", "", "success");
                    getTerm();
                }
            } catch (error) {
                if (error.response.status === 401) {
                    window.location = "/login";
                }
            }
        }
    });
}
