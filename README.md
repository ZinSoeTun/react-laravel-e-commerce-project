- This project is my first project using react 18 for frontend and laravel 10 for backend...
- Languages uses
       - HTML CSS BOOTSTRAP JQUERY REACT SASS LARAVEL 
- This project has two main parts..
- They are User section and Admin session..
- I used React for User Session and Laravel for Admin Session..
- User must log in and admin also log in because each session has different exist url route..
- For user , If user is not logged in, user can search , view products and visit routes and if user is logged in user can search , view products and visit routes and also cart using and order with user's like..
- For admin , Admin must log in if not admin is not used. so admin can insert products , view messages from user and arrange the order for each user
- Must be careful things
       - Don't open the file without internet
       - You can't log in user sesson and admin session at once . (if logged in as a user, don't log in as a admin without logging out as a user and also for reverse..)
- I used jwt token for user and laravel session for admin. ( adjust refresh token )
- If you want to run this file,  you first
     - Download this file or git clone this repository .
     - Open this file on code editer as you like .
     - Type 'composer install'
     - Type 'php artisan key:generate'
     - Type 'php artisan storage:link'
     - Type 'php artisan migrate'
     - Type 'npm install or i vite'
     - If any error found when 'npm install vite' run then type 'npm run audit'
     - Type 'npm run dev'
     - If a patched version is released https://www.npmjs.com/package/axios ,
           run npm install axios@latest --save-dev
     - Install npm and xmapp OR use your local environment .
     - Open apache server and sql  OR use other ways you like.
     - To check any vulnerabilities is existed or not please run npm audit
     - Then run this commands   ' php artisan serve and  npm run dev '
- If you have problems , visit to laravel official website https://laravel.com/docs/10.x/routing
- If you have  problems in react with laravel 10 using vite , visit to https://dcodingsourcecode.darija-coding.com/tutorial/how-to-add-react-js-to-laravel-10-with-vite#google_vignette
-  If you have  problems in jwt in laravel 10 , visit to https://blog.logrocket.com/implementing-jwt-authentication-laravel-10/
- Good luck for your try.😊😊😊😊😊😊😊
