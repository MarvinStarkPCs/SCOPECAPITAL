<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scope Capital</title>
    <style>
        body {
            margin: 0;
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        .logo {
            width: 400px;
            height: 400px;
            background: url('img/logo_small.png') no-repeat center center;
            background-size: contain;
            margin-top: 30px;
            cursor: pointer;
        }

        h1 {
            font-size: 32px;
            margin: 15px 0;
        }

        p {
            font-size: 20px;
            margin: 5px 0;
        }

        .logo:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease;
        }

    </style>
</head>
<body>
    <div class="container" id="container">
        <h1>Welcome to Scope Capital</h1>
        <p>Click on our logo to sign in</p>
        <div class="logo" onclick="redirectToLogin()"></div>
    </div>

    <script>
        function redirectToLogin() {
            const container = document.getElementById('container');
            container.style.opacity = '0'; // Inicia la animación de desvanecimiento
            setTimeout(() => {
                window.location.href = 'login'; // Redirige después de la animación
            }, 1000); // Espera el tiempo de la transición (1s)
        }
    </script>
</body>
</html>
