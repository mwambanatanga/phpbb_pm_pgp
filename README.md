This MOD adds ability to exchange PMs encrypted with PGP. Tested to work in phpBB version 3.0.11 only. Other versions were not tested,thus not guaranteed to work. Feel free to hack.

Functionality details:
* "Edit your PGP key" tab added to the "Profile" section of user control panel. The tab is for uploading a public PGP key to forum.
* "PGP key" item added to user profile. If public PGP key was uploaded, his/her profile shows the key ID and download link.
* An "Encrypt" button added to the PM composing form. If the recipient uploaded his public key, the message will be encrypted with that key.
* If an incoming PM was encrypted, the recipient sees a notification and a form to upload his private key and provide passphrase.
* All encryption and decryption is client-side, performed in the browser, by using JavaScript from the openpgpjs project.

ToDo:
* The encryption and decryption interface is ugly.
* HowTo for end-users.
* i18n is incomplete.