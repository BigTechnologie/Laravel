<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Formulaire d'Envoi d'Email</title>
</head>

<body>
    <div>
        <h1>Envoyer un Email</h1>
      
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
     
        <form action="{{ route('send.mail') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="email">Email du destinataire:</label>
            <input type="email" name="email" id="email" required><br><br>

            <label for="message">Message:</label><br>
            <textarea name="message" id="message" rows="4" required></textarea><br><br>

            <label for="attachment">Pièce jointe:</label>
            <input type="file" name="attachment" id="attachment"><br><br>

            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>

</html>
