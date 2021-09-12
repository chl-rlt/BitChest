# Bitchest 

### Version Laravel 
8.0.0
### Version Vue.js 
3.0.5


# Installation  
<p>1. Launch Apache with MAMP, XAMP or LAMP depending on your operating system</p>
<p>2. Create a Database </p>
<p>3. Edit the ".env" file at the root of the project according to your configuration : 
DB_DATABASE=name of your database
DB_USERNAME=root by default
DB_PASSWORD=your password
</p>
<p>4. In your terminal, then paste the followng commands:
npm install
composer install
php artisan migrate --seed
php artisan key:generate
npm run dev
php artisan schedule:work (to launch the dynamic creation of market prices)
php artisan serve
npm run watch 
</p>

# Login 

### User
<p>email : user@gmail.com</p>
<p>password : password</p>

## Admin 
<p>email : admin@gmail.com</p>
<p>password : password</p>





