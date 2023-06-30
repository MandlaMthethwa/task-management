# Technlogies required
XAMPP (MySQL , APACHE open)

# login in with these credentials
Mail: admin@tasks.com
Password: admin123

# RUN DOCKER
Make sure Docker is installed 
Open terminal and run the following commands:
    docker build -t tasks .
    docker run -p 8000:80 tasks
Access it http://localhost:8080/

# Alternative Install
Run the following
    composer install
    php artisan migrate --seed
    php artisan key:generate
    php artisan serv
    npm install 
    npm run dev 
Acces it http://127.0.0.1:8000/
