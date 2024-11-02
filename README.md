## VittaClinic

VittaClinic é uma aplicação criada para otimizar a administração de clínicas médicas. Seu principal objetivo é automatizar e simplificar o gerenciamento de tarefas como agendamento de consultas, administração de prontuários e cadastro de pacientes e médicos. A plataforma visa oferecer uma experiência eficiente para profissionais de saúde e pacientes, assegurando uma gestão integrada e centralizada das informações.

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


Listar todos os contêineres (inclusive os parados)

bash
docker ps


## Contribuições

Sinta-se à vontade para abrir issues ou enviar pull requests. Toda ajuda é bem-vinda!
