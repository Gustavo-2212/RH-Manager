# RH-Manager

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777bb4)
![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-00758F?logo=mysql&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-2.x-885630?logo=composer&logoColor=white)
![Node.js](https://img.shields.io/badge/Node.js-18.x-339933?logo=nodedotjs&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-5.x-646CFF?logo=vite&logoColor=white)


## 📘 Visão Geral

**RH-Manager** é um sistema de gerenciamento de recursos humanos desenvolvido em Laravel, com foco em facilitar a administração de dados de funcionários, departamentos, permissões de acesso e outras funcionalidades comuns ao setor de RH. A aplicação possui um backend feito em PHP utilizando o framework Laravel, e frontend com Bootstrap e Vite, usando javascript vanilla.

---

## 🛠️ Tecnologias Utilizadas

| Ferramenta   | Versão Sugerida | Descrição                                      |
|--------------|------------------|-----------------------------------------------|
| PHP          | 8.1+             | Linguagem backend principal                   |
| Laravel      | 12.x             | Framework MVC em PHP                          |
| MySQL        | 5.7+             | Banco de dados relacional                     |
| Composer     | 2.x              | Gerenciador de pacotes PHP                    |
| Node.js/NPM  | 18.x / 9.x       | Gerenciador de pacotes JS                     |
| Bootstrap    | 5.x              | Framework CSS para design responsivo          |
| Vite         | 5.x              | Build tool para frontend                      |
| PHPUnit      | 10.x             | Testes automatizados para PHP                 |

---

## ⚙️ Instalação e Configuração

### 🔧 Pré-requisitos

- PHP >= 8.1
- Composer
- Node.js >= 18.x
- MySQL
- NPM

### 🧭 Passo a Passo

1. **Clonar o repositório**
```bash
git clone https://github.com/Gustavo-2212/RH-Manager.git
cd RH-Manager
```

2. Instalar dependências PHP
```bash
composer install
```

3. Instalar dependências Javascript
```bash
npm install
```

4. Criar o arquivo de ambiente (ou usar o que está disponibilizado no github, lembrando de alterar as variáveis referentes a conexão com banco de dados que esteja usando)

5. Executar migrations e seeders (criação das tabelas e suas relações, bem como populando as tabelas com alguns registros padrões, a saber: admin user, departamentos como administração e RH)
```bash
php artisan migrate --seed
```

6. Compilar os assets usados
```bash
npm run dev
```

7. Subindo o servidor da aplicação [http://localhost:8000](http://localhost:8000)
```bash
php artisan serve
```

8. Baixar e executar Mailhog, para subir o servidor de e-mails para o uso da aplicação (lembre de alterar as variáveis de ambiente em .env para usá-lo) - [MailHog](https://github.com/mailhog/MailHog)


### 🔐 Níveis de Acesso e Permissões

O sistema simula de maneira clara e funcional o ambiente de Recursos Humanos de uma empresa, com tarefas essenciais como **cadastro**, **edição** e **remoção de colaboradores**. Para isso, implementa **três níveis distintos de acesso**, cada um com permissões específicas:

### 👑 Admin

O usuário com acesso total ao sistema. Pode administrar toda a estrutura de usuários e departamentos da empresa.

**Permissões:**
- ✅ CRUD completo de usuários do tipo **RH User**
- ✅ Gerenciamento completo dos **departamentos** da empresa
- 💬 Acesso ao **chat interno** (funcionalidade extra implementada além do escopo original do curso na Udemy)

### 🧑‍💼 RH User

Usuário do setor de Recursos Humanos, com permissões voltadas à gestão de colaboradores.

**Permissões:**
- ✅ CRUD completo de usuários do tipo **Colaborator**
- 📝 Edição do **próprio perfil**
- 💬 Acesso ao **chat interno**

### 👤 Colaborator User

Usuário comum (funcionário), com acesso limitado às funcionalidades voltadas à sua própria conta.

**Permissões:**
- 📝 Edição do **próprio perfil**
- 💬 Acesso ao **chat interno**

### 📁 Estrutura do Projeto
```bash
RH-Manager/
├── app/                 # Lógica de negócio (Models, Controllers, Policies)
├── bootstrap/           # Inicialização do Laravel
├── config/              # Arquivos de configuração
├── database/            # Migrations, Seeders, Factories
├── public/              # Assets acessíveis publicamente
├── resources/           # Views (Blade), SCSS, JS
├── routes/              # Rotas web e API
├── storage/             # Arquivos gerados e logs
├── tests/               # Testes com PHPUnit
├── .env.example         # Configurações de ambiente
├── artisan              # CLI do Laravel
├── composer.json        # Dependências PHP
├── package.json         # Dependências JS
├── vite.config.js       # Configurações do Vite
└── README.md            # Este arquivo
```
### 👤 Autor

**[Gustavo Alves](https://github.com/Gustavo-2212)**
