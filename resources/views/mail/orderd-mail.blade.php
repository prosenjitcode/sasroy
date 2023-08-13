<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
    <style>
        
.animation-ctn{
  text-align:center;
  margin-top:5em;
}

	@-webkit-keyframes checkmark {
    0% {
        stroke-dashoffset: 100px
    }

    100% {
        stroke-dashoffset: 200px
    }
}

@-ms-keyframes checkmark {
    0% {
        stroke-dashoffset: 100px
    }

    100% {
        stroke-dashoffset: 200px
    }
}

@keyframes checkmark {
    0% {
        stroke-dashoffset: 100px
    }

    100% {
        stroke-dashoffset: 0px
    }
}

@-webkit-keyframes checkmark-circle {
    0% {
        stroke-dashoffset: 480px
   
    }

    100% {
        stroke-dashoffset: 960px;
      
    }
}

@-ms-keyframes checkmark-circle {
    0% {
        stroke-dashoffset: 240px
    }

    100% {
        stroke-dashoffset: 480px
    }
}

@keyframes checkmark-circle {
    0% {
        stroke-dashoffset: 480px 
    }

    100% {
        stroke-dashoffset: 960px
    }
}

@keyframes colored-circle { 
    0% {
        opacity:0
    }

    100% {
        opacity:100
    }
}

/* other styles */
/* .svg svg {
    display: none
}
 */
.inlinesvg .svg svg {
    display: inline
}

/* .svg img {
    display: none
} */

.icon--order-success svg polyline {
    -webkit-animation: checkmark 0.25s ease-in-out 0.7s backwards;
    animation: checkmark 0.25s ease-in-out 0.7s backwards
}

.icon--order-success svg circle {
    -webkit-animation: checkmark-circle 0.6s ease-in-out backwards;
    animation: checkmark-circle 0.6s ease-in-out backwards;
}
.icon--order-success svg circle#colored {
    -webkit-animation: colored-circle 0.6s ease-in-out 0.7s backwards;
    animation: colored-circle 0.6s ease-in-out 0.7s backwards;
} 
    </style>
</head>

<body>
    <main>
    <div class="container-fluid px-4">
        <div class="row justify-content-center align-items-top g-2">
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Book Store
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="animation-ctn">
                                <div class="icon icon--order-success svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="154px" height="154px">  
                                      <g fill="none" stroke="#22AE73" stroke-width="2"> 
                                        <circle cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                                        <circle id="colored" fill="#22AE73" cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                                        <polyline class="st0" stroke="#fff" stroke-width="10" points="43.5,77.8 63.7,97.9 112.2,49.4 " style="stroke-dasharray:100px, 100px; stroke-dashoffset: 200px;"/>   
                                      </g> 
                                    </svg>
                                  </div>
                          </div>
                          
                          </div>
                        <table class="table table-sm table-borderless text-center mt-4 table-responsive">
                           
                            <tbody>
                              <tr>
                                <th class="card-title">Order Confirmation #</th>
                                <th class="card-title">{{ $order['razorpay_order_id'] }}</th>
                                
                              </tr>
                              <tr>
                                <td>Purchased Item({{ $order['qty'] }})</td>
                                <td>Rs.{{ $order['totalPrice']/100 }}</td>
                              </tr>
                              <tr>
                                <th class="card-title">Total</th>
                                <th class="card-title">Rs.{{ $order['totalPrice']/100 }}</th>
                              </tr>
                            </tbody>
                          </table>
                          <div class="d-flex justify-content-between">
                            <div>
                                <p class="card-title text-b">Address</p>
                                <p class="">Swarnakhali
                                krishnaganj
                                nadia
                                741506</p>
                            </div>
                            <div>
                               
                            </div>
                          </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

</html>
