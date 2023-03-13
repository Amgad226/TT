

## About TT
TT is a FREE web messaging app used for instant messaging, sharing photos, videos, audio recording and group chats.
developed by (laravel blade, js, jQuery, rest api and pusher services)

## Install TT
 after you clone project Rename .env.example file to .env inside your project root
 
 fill the database ,pusher and googleDrive credentials 
 
 and STORE_IN_GOOGLE_DRIVE(true,false), envTyping(true,false), online(true,false),
- envTyping to play (is typing...)  when the user write on keybourd before send message 
- STORE_IN_GOOGLE_DRIVE to store in google drive instaid of local 
- online show (online) when user login to TT


## Run TT
in terminal
- php artisan serve 

- npm run dev

- php artisan queue:work
