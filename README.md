# Mini-app de pagamento de serviços

Este projeto é dividido em **backend (Laravel)** e **frontend (Vue 3 + Tailwind + Vite)**.



##  Estrutura do Repositório

- Backend → Contém a aplicação Laravel (API)
- Frontend` → Contém a aplicação Vue 3 (Interface do usuário)


Dica: cada branch pode conter apenas sua parte (por exemplo `backend` branch só o backend).



## Tecnologias

### Backend
- Laravel 10
- PHP 8.1+
- MySQL
- Composer (gerenciador de pacotes PHP)

### Frontend
- Vue 3 
- Tailwind CSS + Flowbite
- Vite
- Axios



## Instalação do Backend (Laravel)

- Clone a branch do backend:
- git clone -b backend https://github.com/Solange1030/Services_Payment.git
- cd Services_Payments
- composer install
- cp .env.example .env
- php artisan migrate --seed
- php artisan serve     // para rodar


## Instalação do Frontend (Vue)

- Clone a branch do frontend:
- git clone -b frontend https://github.com/Solange1030/Services_Payment.git
- cd Services_Payments
- npm install
- npm run dev
