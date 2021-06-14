# RentHouse
Steps to deploy to 000webhost
[1] Run make_tar.py
[2] Upload the file in 000webhost filemanager
[3] Extract the file and then delete it
[4] For each tar file in the directory, repeat step 3 and 4
[5] Go to the root directory, create tmp/, create .server/
[6] Rename public to public_html

#Create Database
[7] Go to 000webhost>Manage Website>Database Manager>Create Database
[8] Create a database
[9] Update private/passwords.php db_username db_password db_name
[10] Go to mange database
[11] Run all the sql commands in private/sql