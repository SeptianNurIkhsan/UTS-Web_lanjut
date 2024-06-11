<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 300px;
        text-align: center;
    }

    .container h2 {
        margin-bottom: 20px;
        color: #1877f2;
    }

    .container input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .container button {
        background-color: #1877f2;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    .container button:hover {
        background-color: #1558a5;
    }

    .alert {
        color: red;
        margin-bottom: 10px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <?php if(session()->getFlashdata('msg')):?>
        <div class="alert">
            <?= session()->getFlashdata('msg') ?>
        </div>
        <?php endif;?>
        <form method="post" action="/login">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>