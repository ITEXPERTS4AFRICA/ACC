<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>body{font-family:Arial,sans-serif;color:#2C1A0E;background:#FDFAF6;margin:0;padding:20px}.container{max-width:600px;margin:auto;background:#fff;border:1px solid #E8DDD0;border-radius:2px;overflow:hidden}.header{background:#2C1A0E;color:white;padding:24px;}.header h1{margin:0;font-size:18px}.body{padding:24px}.field{margin-bottom:16px;border-bottom:1px solid #E8DDD0;padding-bottom:16px}.label{font-size:12px;text-transform:uppercase;letter-spacing:2px;color:#6B5A4E;margin-bottom:4px}.value{font-size:14px}.message-box{background:#F5EFE6;padding:16px;border-left:4px solid #8B1A1A;margin-top:16px;font-size:14px;line-height:1.6}.footer{background:#F5EFE6;padding:16px;font-size:12px;color:#6B5A4E;text-align:center}</style></head>
<body>
<div class="container">
    <div class="header"><h1>Nouveau message – Atlantic Cocoa Corporation</h1></div>
    <div class="body">
        <div class="field"><div class="label">Nom</div><div class="value">{{ $contactMessage->name }}</div></div>
        <div class="field"><div class="label">Email</div><div class="value">{{ $contactMessage->email }}</div></div>
        @if($contactMessage->company)<div class="field"><div class="label">Société</div><div class="value">{{ $contactMessage->company }}</div></div>@endif
        @if($contactMessage->country)<div class="field"><div class="label">Pays</div><div class="value">{{ $contactMessage->country }}</div></div>@endif
        <div class="field"><div class="label">Objet</div><div class="value">{{ $contactMessage->subject }}</div></div>
        <div class="message-box">{{ $contactMessage->message }}</div>
    </div>
    <div class="footer">Atlantic Cocoa Corporation — {{ now()->format('d/m/Y H:i') }}</div>
</div>
</body>
</html>
