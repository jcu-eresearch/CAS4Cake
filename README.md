# CAS Auth for CakePHP example #

1. Put phpCAS files in app/Vendor
2. Take a copy of app/Controller/Component/Auth/CasAuthenticate.php
3. Configure CAS settings in app/Config/core.php
4. Make sure CakePHP setting Session.cookie is set the "PHPSESSID". This is because CAS will be using the default PHP session name but CakePHP uses a different session name by default (see app/Config/core.php).
5. When configuring AuthComponent, tell it to use CasAuthenticate (see app/Controllers/AppController.php)
6. Use the CakePHP AuthComponent like you normally would

## What it doesn't do yet ##

Doesn't save the user to the local database at all. Just stores the users email address in the session.
