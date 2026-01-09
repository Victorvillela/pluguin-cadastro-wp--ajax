# 🧩 Plugin de Cadastro de Usuários – WordPress

Plugin WordPress desenvolvido em **PHP** para fins educacionais, que permite o **cadastro de usuários personalizados** através do painel administrativo, armazenando os dados em uma **tabela própria no banco de dados** e exibindo os registros via **shortcode**.

---

## 🚀 Funcionalidades

- 📋 Cadastro de usuários via painel administrativo
- 🗄️ Criação automática de tabela no banco de dados
- 🔐 Sanitização de dados
- 📄 Listagem dos usuários cadastrados
- 🧩 Shortcode para exibição em páginas/posts
- 🧠 Estrutura básica de plugin WordPress

---

## 🛠️ Tecnologias Utilizadas

- PHP 7.4+
- WordPress 5.0+
- MySQL
- HTML + CSS
- WordPress Hooks & Shortcodes

---

## 📂 Estrutura do Plugin
plugin-cadastro/
├── plugin-cadastro.php
├── assets/
│ └── js/
│ └── script.js
└── README.md


---

## ▶️ Instalação

1. Copie a pasta do plugin para o diretório:
wp-content/plugins/

2. Acesse o painel administrativo do WordPress
3. Ative o plugin em **Plugins > Plugins Instalados**
4. Um novo menu chamado **Cadastro** será exibido no painel

---

## 📝 Cadastro de Usuários

- Acesse o menu **Cadastro**
- Preencha o formulário disponível
- Os dados são armazenados na tabela personalizada:

wp_palhacada

---

## 📄 Exibição dos Dados (Shortcode)

Para exibir a lista de usuários cadastrados em uma página ou post, utilize o shortcode:

[login_auth_form]


O shortcode renderiza uma tabela com os usuários cadastrados no banco de dados.

---

## 🔐 Segurança e Validações

- Sanitização dos dados com funções nativas do WordPress
- Verificação de permissões de usuário
- Prevenção contra acesso direto ao arquivo
- Uso de `$wpdb` para manipulação do banco de dados

---

## ⚠️ Limitações Conhecidas

- Plugin desenvolvido para fins educacionais
- Não utiliza autenticação nativa do WordPress
- Não possui persistência avançada ou logs
- Não utiliza Nonce (recomendado para produção)

---

## 🚧 Melhorias Futuras

- Implementar Nonce para segurança avançada
- Separação completa de PHP, HTML, CSS e JS
- Implementar AJAX para cadastro e listagem
- Transformar o sistema em um CRUD completo
- Adicionar paginação e filtros na listagem
- Compatibilizar com padrões WordPress Coding Standards

---

## 👨‍💻 Autor

Victor Villela  

Projeto desenvolvido para estudo e prática de **desenvolvimento de plugins WordPress**.

---

## 📄 Licença

Este projeto é de uso livre para fins educacionais e de aprendizado.


O shortcode renderiza uma tabela com os usuários cadastrados no banco de dados.

---

## 🔐 Segurança e Validações

- Sanitização dos dados com funções nativas do WordPress
- Verificação de permissões de usuário
- Prevenção contra acesso direto ao arquivo
- Uso de `$wpdb` para manipulação do banco de dados

---

## ⚠️ Limitações Conhecidas

- Plugin desenvolvido para fins educacionais
- Não utiliza autenticação nativa do WordPress
- Não possui persistência avançada ou logs
- Não utiliza Nonce (recomendado para produção)

---

## 🚧 Melhorias Futuras

- Implementar Nonce para segurança avançada
- Separação completa de PHP, HTML, CSS e JS
- Implementar AJAX para cadastro e listagem
- Transformar o sistema em um CRUD completo
- Adicionar paginação e filtros na listagem
- Compatibilizar com padrões WordPress Coding Standards

---

## 👨‍💻 Autor

Victor Villela  

Projeto desenvolvido para estudo e prática de **desenvolvimento de plugins WordPress**.

---

## 📄 Licença

Este projeto é de uso livre para fins educacionais e de aprendizado.




