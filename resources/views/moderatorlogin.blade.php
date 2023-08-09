<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator Login</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: black;
        }

        .container {
            height: 31.25em;
            width: 31.25em;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
        }

        form {
            width: 23.75em;
            height: 18.75em;
            background-color: #ffffff;
            position: absolute;
            transform: translate(-50%, -50%);
            top: calc(50% + 3.1em);
            left: 50%;
            padding: 0 3.1em;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: 0.5em;
        }

        form label {
            display: block;
            margin-bottom: 0.2em;
            font-weight: 600;
            color: #2e0d30;
        }

        form input {
            font-size: 0.95em;
            font-weight: 400;
            color: #3f3554;
            padding: 0.3em;
            border: none;
            border-bottom: 0.12em solid #3f3554;
            outline: none;
        }

        form input:focus {
            border-color: #adc178;
        }

        form input:not(:last-child) {
            margin-bottom: 0.9em;
        }

        form button {
            font-size: 0.95em;
            padding: 0.8em 0;
            border-radius: 2em;
            border: none;
            outline: none;
            background-color: #2e0d30;
            color: white;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.15em;
            margin-top: 0.8em;
        }

        button:hover {
            opacity: 0.8;
            cursor: pointer;
        }

        .fytyra-ariut {
            height: 7.5em;
            width: 8.4em;
            background-color: gray;
            border: 0.18em solid #2e0d30;
            border-radius: 7.5em 7.5em 5.62em 5.62em;
            position: absolute;
            top: 2em;
            margin: auto;
            left: 0;
            right: 0;
        }

        .veshi-m,
        .veshi-d {
            background-color: gray;
            height: 2.5em;
            width: 2.81em;
            border: 0.18em solid #2e0d30;
            border-radius: 10px 10px 10px 10px;
            top: 1.75em;
            position: absolute;
        }

        .veshi-m {
            transform: rotate(-38deg);
            left: 10.75em;
        }

        .veshi-d {
            transform: rotate(38deg);
            right: 10.75em;
        }

        .blush-l {
            transform: rotate(25deg);
            left: 1em;
        }

        .blush-r {
            transform: rotate(-25deg);
            right: 1em;
        }

        .eye-l,
        .eye-r {
            background-color: white;
            height: 2.18em;
            width: 2em;
            border-radius: 2em;
            position: absolute;
            top: 2.18em;
        }

        .eye-l {
            left: 1.37em;
            transform: rotate(-20deg);
        }

        .eye-r {
            right: 1.37em;
            transform: rotate(20deg);
        }

        .eyeball-l,
        .eyeball-r {
            height: 0.8em;
            width: 0.8em;
            background-color: red;
            border-radius: 50%;
            position: absolute;
            left: 0.6em;
            top: 0.6em;
            transition: 1s all;
        }

        .eyeball-l {
            transform: rotate(20deg);
        }

        .eyeball-r {
            transform: rotate(-20deg);
        }

        .hunda {
            height: 1em;
            width: 1em;
            background-color: #2e0d30;
            position: absolute;
            top: 4.37em;
            margin: auto;
            left: 0;
            right: 0;
            border-radius: 1.2em 0 0 0.25em;
            transform: rotate(45deg);
        }

        .hunda:before {
            content: "";
            position: absolute;
            background-color: #2e0d30;
            height: 0.6em;
            width: 0.1em;
            transform: rotate(-45deg);
            top: 0.75em;
            left: 1em;
        }

        .goja,
        .goja:before {
            height: 0.75em;
            width: 0.93em;
            background-color: transparent;
            position: absolute;
            border-radius: 50%;
            box-shadow: 0 0.18em #2e0d30;
        }

        .goja {
            top: 5.31em;
            left: 3.12em;
        }

        .goja:before {
            content: "";
            position: absolute;
            left: 0.87em;
        }

        .hand-l,
        .hand-r {
            background-color: gray;
            height: 2.81em;
            width: 2.5em;
            border: 0.18em solid #2e0d30;
            border-radius: 0.6em 0.6em 2.18em 2.18em;
            transition: 1s all;
            position: absolute;
            top: 8.4em;
        }

        .hand-l {
            left: 7.5em;
        }

        .hand-r {
            right: 7.5em;
        }

        .putra-l,
        .putra-r {
            background-color: gray;
            height: 3.12em;
            width: 3.12em;
            border: 0.18em solid #2e0d30;
            border-radius: 2.5em 2.5em 1.2em 1.2em;
            position: absolute;
            top: 26.56em;
        }

        .putra-l {
            left: 10em;
        }

        .putra-r {
            right: 10em;
        }

        .putra-l:before,
        .putra-r:before {
            position: absolute;
            content: "";
            background-color: #2e0d30;
            height: 1.37em;
            width: 1.75em;
            top: 1.12em;
            left: 0.55em;
            border-radius: 1.56em 1.56em 0.6em 0.6em;
        }

        .putra-l:after,
        .putra-r:after {
            position: absolute;
            content: "";
            background-color: #2e0d30;
            height: 0.5em;
            width: 0.5em;
            border-radius: 50%;
            top: 0.31em;
            left: 1.12em;
            box-shadow: 0.87em 0.37em #2e0d30, -0.87em 0.37em #2e0d30;
        }

        @media screen and (max-width: 500px) {
            .container {
                font-size: 14px;
            }
        }

        h1 {
            color: white;
            text-align: center;
            font-size: 72px;
        }

        arquee {
            font-size: 17px;
            font-weight: 800;
            color: #835C3B;
            font-family: sans-serif;
            margin-bottom: 47%;
        }
    </style>
</head>

<body>
    <h1 class="ariu">Moderator Login</h1>

    <div class="container">
        <form action="" method="POST">
            @csrf
            <label for="username">Username: </label>
            <input type="text" id="username" placeholder="Enter username..." />
            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter password..." />
            <button type="submit">Login</button>
            <br>
            <a style="text-align: center;" href="">Forgot Password?</a>
        </form>

        <div class="veshi-m"></div>
        <div class="veshi-d"></div>
        <div class="fytyra-ariut">
            <div class="eye-l">
                <div class="eyeball-l"></div>
            </div>
            <div class="eye-r">
                <div class="eyeball-r"></div>
            </div>
            <div class="hunda"></div>
            <div class="goja"></div>
        </div>
        <div class="hand-l"></div>
        <div class="hand-r"></div>
        <div class="putra-l"></div>
        <div class="putra-r"></div>
    </div>
</body>

<script>
    let usernameRef = document.getElementById("username");
    let passwordRef = document.getElementById("password");
    let eyeL = document.querySelector(".eyeball-l");
    let eyeR = document.querySelector(".eyeball-r");
    let handL = document.querySelector(".hand-l");
    let handR = document.querySelector(".hand-r");

    let normalEyeStyle = () => {
        eyeL.style.cssText = `
    left:0.6em;
    top: 0.6em;
  `;
        eyeR.style.cssText = `
  right:0.6em;
  top:0.6em;
  `;
    };

    let normalHandStyle = () => {
        handL.style.cssText = `
        height: 2.81em;
        top:8.4em;
        left:7.5em;
        transform: rotate(0deg);
    `;
        handR.style.cssText = `
        height: 2.81em;
        top: 8.4em;
        right: 7.5em;
        transform: rotate(0deg)
    `;
    };
    //Kur klikohet në futjen e emrit të përdoruesit
    usernameRef.addEventListener("focus", () => {
        eyeL.style.cssText = `
    left: 0.75em;
    top: 1.12em;  
  `;
        eyeR.style.cssText = `
    right: 0.75em;
    top: 1.12em;
  `;
        normalHandStyle();
    });
    //Kur klikohet në futjen e fjalëkalimit
    passwordRef.addEventListener("focus", () => {
        handL.style.cssText = `
        height: 6.56em;
        top: 3.87em;
        left: 11.75em;
        transform: rotate(-155deg);    
    `;
        handR.style.cssText = `
    height: 6.56em;
    top: 3.87em;
    right: 11.75em;
    transform: rotate(155deg);
  `;
        normalEyeStyle();
    });
    //Kur klikohet jashtë hyrjes së emrit të përdoruesit dhe fjalëkalimit
    document.addEventListener("click", (e) => {
        let clickedElem = e.target;
        if (clickedElem != usernameRef && clickedElem != passwordRef) {
            normalEyeStyle();
            normalHandStyle();
        }
    });
</script>

</html>