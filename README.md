# 🗂️ NoteStack

NoteStack é uma aplicação web de anotações simples e intuitiva, desenvolvida com Laravel 11, Tailwind CSS e Vite.  
Com ele, você pode criar, visualizar, favoritar e excluir notas de forma rápida e prática, com uma interface agradável e responsiva.

---

## 🚀 Funcionalidades

- ✅ Criar notas com título, conteúdo e cor personalizada
- ⭐ Marcar/desmarcar como favoritas
- 🗑️ Excluir notas
- 🎨 Interface visual moderna com Tailwind CSS
- ⚡ Hot reload com Vite

---

## 🖼️ Preview

> Você pode adicionar uma imagem chamada `screenshot.png` aqui na raiz do projeto para aparecer nesta seção.

---

## 🛠️ Tecnologias Utilizadas

- [Laravel 11](https://laravel.com/)
- [Tailwind CSS 3](https://tailwindcss.com/)
- [Vite](https://vitejs.dev/)
- SQLite (como banco de dados padrão)

---

## ⚙️ Como Rodar o Projeto

### 1. Clone o Repositório

```bash
git clone https://github.com/Vinicius-Brunoo/notestack.git
cd notestack

2. Instale as Dependências PHP e JavaScript
composer install
npm install

3. Configure o Ambiente
cp .env.example .env
php artisan key:generate

Se estiver usando SQLite, crie o arquivo de banco:
touch database/database.sqlite

E no .env, configure assim:

DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite

4. Rode as Migrations
php artisan migrate

5. Inicie os Servidores
Abra dois terminais:

Terminal 1: Backend Laravel
php artisan serve

Terminal 2: Frontend Vite
npm run dev
