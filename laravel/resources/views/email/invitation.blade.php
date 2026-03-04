<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invitation Colocation</title>
</head>

<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 40px 0;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    <tr>
                        <td align="center" style="padding: 40px 40px 20px 40px;">
                            <h1 style="color: #4f46e5; margin: 0; font-size: 28px; font-weight: 800; letter-spacing: -1px;">EasyColoc.</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 40px 40px; text-align: center;">
                            <p style="font-size: 18px; color: #1e293b; line-height: 1.6; margin-bottom: 24px;">
                                Bonjour ! Vous avez été invité à rejoindre une nouvelle colocation.
                            </p>

                            <div style="background-color: #f1f5f9; border-radius: 12px; padding: 20px; margin-bottom: 30px;">
                                <p style="margin: 0; font-size: 14px; color: #64748b; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Invitation pour l'email :</p>
                                <p style="margin: 5px 0 0 0; font-size: 18px; color: #0f172a; font-weight: 700;">{{ $invitation->email }}</p>
                            </div>

                            <p style="font-size: 16px; color: #475569; margin-bottom: 30px;">
                                Connectez-vous à votre tableau de bord pour accepter ou refuser cette invitation.
                            </p>

                            <a href="{{ route('login') }}"
                                style="background-color: #4f46e5; color: #ffffff; padding: 16px 32px; text-decoration: none; border-radius: 12px; font-weight: 700; font-size: 14px; display: inline-block; text-transform: uppercase; letter-spacing: 1px;">
                                Voir mon Dashboard
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 40px; background-color: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="font-size: 12px; color: #94a3b8; margin: 0;">
                                Cet email a été envoyé par la plateforme EasyColoc.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>