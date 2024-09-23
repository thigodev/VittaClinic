# README para Configuração do Ambiente de Desenvolvimento

Este documento contém instruções para configurar o ambiente de desenvolvimento utilizando XAMPP, PHP e Git.

## Pré-requisitos

- Um computador com Windows, macOS ou Linux.
- Acesso à internet para baixar os softwares necessários.

## Passo 1: Instalação do XAMPP

1. **Baixar XAMPP:**
   - Acesse o site oficial do [XAMPP](https://www.apachefriends.org/index.html).
   - Selecione a versão apropriada para o seu sistema operacional e faça o download.

2. **Instalar XAMPP:**
   - Execute o instalador baixado.
   - Siga as instruções na tela, certificando-se de selecionar o Apache e o MySQL durante a instalação.

3. **Iniciar XAMPP:**
   - Abra o painel de controle do XAMPP.
   - Inicie os módulos **Apache** e **MySQL** clicando nos botões "Start".

4. **Verificar a instalação:**
   - Abra o navegador e digite `http://localhost/`. Você deve ver a página de boas-vindas do XAMPP.

## Passo 2: Configuração do PHP

1. **Verificar versão do PHP:**
   - O XAMPP já vem com PHP pré-instalado. Para verificar a versão, crie um arquivo `info.php` na pasta `htdocs` (normalmente localizada em `C:\xampp\htdocs`) com o seguinte conteúdo:
     ```php
     <?php phpinfo(); ?>
     ```
   - Acesse `http://localhost/info.php` no navegador para ver a configuração do PHP.

2. **Modificar configurações do PHP (opcional):**
   - Você pode editar o arquivo `php.ini`, localizado em `C:\xampp\php\php.ini`, para modificar configurações, como `upload_max_filesize` e `post_max_size`.

## Passo 3: Instalação do Git

1. **Baixar Git:**
   - Acesse o site oficial do [Git](https://git-scm.com/).
   - Faça o download do instalador correspondente ao seu sistema operacional.

2. **Instalar Git:**
   - Execute o instalador e siga as instruções na tela.
   - É recomendado deixar as opções padrão marcadas durante a instalação.

3. **Verificar a instalação:**
   - Abra o terminal (ou o Git Bash no Windows) e digite:
     ```bash
     git --version
     ```
   - Você deve ver a versão do Git instalada.

## Passo 4: Configuração do Git

1. **Configurar informações do usuário:**
   - No terminal, defina seu nome e e-mail:
     ```bash
     git config --global user.name "Seu Nome"
     git config --global user.email "seuemail@example.com"
     ```

2. **Verificar configurações:**
   - Para verificar as configurações, execute:
     ```bash
     git config --list
     ```

## Passo 5: Clonando um repositório

Para clonar um repositório Git, use o seguinte comando:

```bash
git clone https://github.com/usuario/repositorio.git
