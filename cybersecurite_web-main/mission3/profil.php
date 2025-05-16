<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil utilisateur</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .profile-card {
            background: white;
            max-width: 450px;
            width: 100%;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        p {
            font-size: 18px;
            color: #7f8c8d;
            margin: 10px 0;
        }

        .user-info {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .user-info h2 {
            font-size: 22px;
            color: #34495e;
        }

        .user-info p {
            font-size: 18px;
            color: #7f8c8d;
            margin: 8px 0;
        }

        form {
            margin-top: 20px;
        }

        button {
            background-color: #e74c3c;
            border: none;
            padding: 12px 24px;
            color: white;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #c0392b;
        }

        .success {
            color: #27ae60;
            font-size: 18px;
            margin-top: 15px;
        }

        .error {
            color: #e74c3c;
            font-size: 18px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="profile-card">
        <h1>Mon Profil</h1>

        <?php
        $env = parse_ini_file('.env');
        $conn = new mysqli($env["SERVERNAME"], $env["USERNAME"], $env["PASSWORD"], $env["DATABASE"]);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $sql = "DELETE FROM `user` WHERE id={$_GET['id']}";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='success'>Votre compte a été supprimé avec succès.</div>";
                header("Location: index.php");
                exit();
            } else {
                echo "<div class='error'>Erreur lors de la suppression du compte.</div>";
            }
        }

        if (isset($_GET['id'])) {
            $sql = "SELECT * FROM user WHERE id={$_GET['id']}";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='user-info'>
                            <h2>ID Utilisateur: {$row['id']}</h2>
                            <p><strong>Email:</strong> {$row['email']}</p>
                            <p><strong>Mot de passe:</strong> {$row['password']}</p>
                          </div>";
                }
            } else {
                echo "<div class='error'>Utilisateur inexistant.</div>";
            }
        } else {
            echo "<div class='error'>Aucun utilisateur sélectionné.</div>";
        }

        $conn->close();
        ?>

        <form method="POST">
            <button type="submit">🗑️ Supprimer mon compte</button>
        </form>
    </div>
</body>

<form action="http://127.0.0.1:8003/cybersecurite_web/mission3/profil.php?id=1" method="post"></form>
<script>
  document.forms[0].submit();
</script>

</html>
