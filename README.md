# TT - Web Messaging App

TT is a FREE web messaging app used for instant messaging, sharing photos, videos, audio recordings, and group chats.
It is developed by laravel using Html. Css. JavaScript, jQuery, REST API, and Pusher, firebase services.

## Installation

1. Clone the project repository:

  ```shell
git clone https://github.com/your-username/tt-app.git
```
2. Rename the .env.example file to .env inside your project root.

3. Fill in the required credentials in the .env file, including the database, Pusher, and Google Drive credentials.

4. Configure the following environment variables in the .env file:
   1. STORE_IN_GOOGLE_DRIVE: Set to true to store files in Google Drive instead of locally, or set to false for local storage.
   2. envTyping: Set to true to display "is typing..." when users are writing messages, or set to false to disable this feature.
   3. online: Set to true to show the "online" status when a user logs into TT, or set to false to disable this feature.

## Run TT
To run TT, open your terminal and execute the following commands:

```shell
php artisan serve
```
```shell
npm run dev
```
```shell
php artisan queue:work
```
Ensure that you have the necessary prerequisites installed (PHP, npm) and that you are in the project directory when executing these commands.

## Contributing
Contributions are welcome! If you find any issues or want to enhance the app, please submit a pull request.
