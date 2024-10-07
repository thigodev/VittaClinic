## VittaClinic

VittaClinic uma aplicação desenvolvida para facilitar o gerenciamento de clínicas médicas. O objetivo principal do sistema é automatizar e simplificar o controle de operações como o agendamento de consultas, gerenciamento de prontuários, cadastro de pacientes e médicos. A plataforma busca proporcionar uma experiência eficiente tanto para os profissionais da saúde quanto para os pacientes, garantindo uma gestão integrada e centralizada de informações.

## Sumário

- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Configurando o Ambiente com Docker](#configurando-o-ambiente-com-docker)
- [Comandos Úteis do Docker](#comandos-úteis-do-docker)
- [Contribuições](#contribuições)
- [Licença](#licença)

## Pré-requisitos

Antes de iniciar, você precisa ter o seguinte software instalado na sua máquina:

- [Docker](https://www.docker.com/get-started) (Docker Desktop para Windows/Mac, Docker Engine para Linux)

Verifique se o Docker está corretamente instalado executando o comando:

bash
docker --version

-------------------------------------------------------------------------------------------------------------

Configurando o Ambiente com Docker
Siga os passos abaixo para configurar e executar o ambiente de desenvolvimento com Docker:

Passo 1: Construir a imagem Docker
No diretório raiz do projeto, execute o comando abaixo para criar a imagem Docker:

bash
docker-compose up --build

Passo 2: Rodando o contêiner
Depois de criar a imagem, inicie o contêiner com o comando:

bash
docker-compose up -d
O -d executa o contêiner em segundo plano.

bash
Copiar código
docker ps
Listar todos os contêineres (inclusive os parados):

## Contribuições

Sinta-se à vontade para abrir issues ou enviar pull requests. Toda ajuda é bem-vinda!
