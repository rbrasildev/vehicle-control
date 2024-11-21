<link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;700&display=swap');
    @import 'animation.css';

    body {
        background: linear-gradient(to left, #0061a8, #011d33);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        width: 100vw;
    }

    .wrap {
        background-image: url('../img/background.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
    }

    .bg-cx-primary {
        background: #044272;
    }

    .bg-cx-secondary {
        background: #79C83D;
    }

    .text-cx-primary {
        color: #0072C6;
    }

    .cx-container {
        max-width: 400px;
        max-height: 600px;
        background: rgb(4, 66, 114, 0.6);
        transition: 0.5s;
        /*
        border-radius: 50px;**/
    }

    button {
        transition: 0.3ms;
        color: #fff;
    }

    button:hover {
        background: #4e9c12
    }

    @media screen and (max-width: 576px) {
        .cx-container {
            background: none;
        }

        body {
            background: radial-gradient(to left, #00375e, #011d33);
        }
    }

    .tracking-in-expand {
        -webkit-animation: tracking-in-expand 0.7s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
        animation: tracking-in-expand 0.9s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
    }

    .shake-horizontal {
        -webkit-animation: shake-horizontal 0.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
        animation: shake-horizontal 0.8s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
    }
</style>

<div class="wrap">
    <div class="d-flex align-items-center justify-content-center cx-container p-4 rounded shadow-sm">

        <div class="row gap-4 p-4">
            <div class="img text-center">
                <img class="img-fluid mt-4" src="img/logo.png" width="250" alt="ConexãoNet">
            </div>

            <div style="font-family: 'Montserrat', sans-serif" class="title mt-2">
                <h3 class="mt-4 text-light text-center tracking-in-expand"><strong>SEJA BEM VINDO</strong></h3>
                <p class="text-light text-center lw-1">Um novo conceito de internet</p>
            </div>

            <div class="d-flex align-items-center bg-light rounded mb-2">
                <select style="font-size:large; border:none" class="form-control form-select p-3" name="city"
                    id="city">
                    <option selected value="selected">Selecione sua cidade</option>
                    <option value="pacaja">Pacajá-PA</option>
                    <option value="anapu">Anapu-PA</option>
                    <option value="parintins">Parintins-AM</option>
                </select>
            </div>

            <button id="submit" class="btn p-3 bg-cx-secondary">Entrar</button>

            <div class="footer d-flex p-4 justify-content-around align-items-center">
                <div style="font-size:30px" class="text-light icons">
                    <i class='bx bxl-whatsapp'></i>
                    <i class='bx bx-phone'></i>
                </div>
                <h3 style="cursor:pointer" id="whatssap" class="text-light"> 0800 878 2380</h3>
            </div>

        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const city = document.querySelector("#city")
    const btnSubmit = document.querySelector("#submit");

    window.onload = function() {
        document.getElementById("spinner").style.display = "none";
        document.querySelector(".wrap").style.display = "inline-flex";
    };

    btnSubmit.addEventListener('click', () => {
        const valorCity = city.value;
        if (valorCity == 'pacaja') {
            window.open('http://sgp.redeconexaonet.com.br:8000/accounts/central/login')
        }

        if (valorCity == 'anapu') {
            window.open('http://sgp2.redeconexaonet.com.br:8000/accounts/central/login')
        }

        if (valorCity == 'parintins') {
            window.open('https://sgptins.redeconexaonet.com/accounts/central/login')
        }

        if (valorCity == 'selected') {
            btnSubmit.classList.add('shake-horizontal')
            $.toast({
                heading: 'Warning',
                text: 'Por favor selecione sua cidade e depois clique em entrar ;)',
                showHideTransition: 'plain',
                icon: 'warning',
                position: 'top-right'
            })
        }

    })
</script>
