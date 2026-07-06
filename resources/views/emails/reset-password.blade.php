<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding:20px;">
    <div style="max-width:500px;margin:0 auto;background:#fff;padding:30px;border-radius:8px;">
        <h2>Reinitialisation de mot de passe</h2>
        <p>Bonjour {{ $username }},</p>
        <p>Vous avez demande a reinitialiser votre mot de passe sur Tijara.</p>
        <p>Voici votre code de reinitialisation, valable 60 minutes :</p>
        <p style="font-size:24px;font-weight:bold;letter-spacing:2px;background:#f0f0f0;padding:10px 20px;text-align:center;border-radius:6px;">
            {{ $token }}
        </p>
        <p>Utilisez ce code dans l'application pour choisir un nouveau mot de passe.</p>
        <p>Si vous n'etes pas a l'origine de cette demande, ignorez simplement cet email.</p>
    </div>
</body>
</html>