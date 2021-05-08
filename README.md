
# UsersTimeLogged

## Installation

**backend** y **frontend**

### Requeriments backend
- PHP >= 7.3
- OpenSSL PHP Extension
- Mbstring PHP Extension
- Composer https://getcomposer.org/

### Requeriments frontend
- Node JS https://nodejs.org/en/
- NPM https://www.npmjs.com/get-npm

### backend
From console:

```bash  
cd backend  
```  

```bash    
composer install  
    
cp .env.example .env  
    
php artisan key:generate
```


###Copy .sql files into
/backend/database/seeders/sql

```bash    
php artisan migrate:fresh --seed  
```  

```bash    
php artisan serve --port=8000
```  

### frontend
From console:

```bash    
cd frontend  
```  

```bash    
npm install  
```  

```bash    
npm run serve -- --port 8080  
```

## Development architecture

Test-Driven Development

## Design Patterns

Repository Design Pattern
