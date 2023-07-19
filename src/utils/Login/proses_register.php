<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $file = file('registration_data.txt', FILE_IGNORE_NEW_LINES);
    $caseSensitiveUsername = false;

    foreach ($file as $line) {
        $credentials = explode(", ", $line);
        $storedUsername = explode(": ", $credentials[0])[1];

        if (strcasecmp($username, $storedUsername) === 0) {
            $caseSensitiveUsername = true;
            break;
        }
    }

    if ($caseSensitiveUsername) {
        $errorMessage = 'Username sudah ada. Silakan pilih username yang lain.';
        header('Location: register?error=' . urlencode($errorMessage));
        exit;
    } else {
        $data = "Username: " . $username . ", Password: " . $password . ", Role: member" . PHP_EOL;
        file_put_contents('registration_data.txt', $data, FILE_APPEND);

        echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Registration Success</title>
                    <style>
                        @keyframes spin3D {
                            from {
                                transform: rotate3d(.5,.5,.5, 360deg);
                            }
                            to {
                                transform: rotate3d(0deg);
                            }
                        }

                        * {
                            box-sizing: border-box;
                        }

                        body {
                            min-height: 100vh;
                            background-color: #1d2630;
                            display: flex;
                            justify-content: center;
                            flex-wrap: wrap;
                            align-items: center;
                        }

                        .spinner-box {
                            width: 300px;
                            height: 300px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            background-color: transparent;
                        }

                        .leo {
                            position: absolute;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            border-radius: 50%;
                        }

                        .blue-orbit {
                            width: 165px;
                            height: 165px;
                            border: 1px solid #91daffa5;
                            animation: spin3D 3s linear .2s infinite;
                        }

                        .green-orbit {
                            width: 120px;
                            height: 120px;
                            border: 1px solid #91ffbfa5;
                            animation: spin3D 2s linear 0s infinite;
                        }

                        .red-orbit {
                            width: 90px;
                            height: 90px;
                            border: 1px solid #ffca91a5;
                            animation: spin3D 1s linear 0s infinite;
                        }

                        .white-orbit {
                            width: 60px;
                            height: 60px;
                            border: 2px solid #ffffff;
                            animation: spin3D 10s linear 0s infinite;
                        }

                        .w1 {
                            transform: rotate3D(1, 1, 1, 90deg);
                        }

                        .w2 {
                            transform: rotate3D(1, 2, .5, 90deg);
                        }

                        .w3 {
                            transform: rotate3D(.5, 1, 2, 90deg);
                        }
                    </style>
                    <script>
                        setTimeout(function() {
                            window.location.href = "login";
                        }, 5000);
                    </script>
                </head>
                <body>
                    <div class="spinner-box"></div>
                    <div class="blue-orbit leo"></div>
                    <div class="green-orbit leo"></div>
                    <div class="red-orbit leo"></div>
                    <div class="white-orbit w1 leo"></div>
                    <div class="white-orbit w2 leo"></div>
                    <div class="white-orbit w3 leo"></div>
                </body>
                </html>';
        exit;
    }
}
?>