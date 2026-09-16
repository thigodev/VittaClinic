# VittaClinic

O **VittaClinic** é uma plataforma desenvolvida para otimizar a administração de clínicas médicas. Seu propósito é simplificar tarefas como agendamento de consultas, gerenciamento de prontuários e cadastro de pacientes e médicos. A solução oferece uma experiência integrada e eficiente, tanto para profissionais de saúde quanto para pacientes.

---

## Sumário

- [Pré-requisitos](#pré-requisitos)  
- [Instalação](#instalação)  
- [Configuração com Docker](#configuração-com-docker)  
- [Comandos Úteis do Docker](#comandos-úteis-do-docker)  
- [Como Contribuir](#como-contribuir)  
- [Licença](#licença)  

---

## Pré-requisitos

Antes de começar, verifique se você possui o seguinte instalado:

- [Docker](https://www.docker.com/get-started) (Docker Desktop para Windows/Mac ou Docker Engine para Linux)

Para confirmar a instalação do Docker, execute:  
```bash
docker --version
```

---

## Configuração com Docker

Configure o ambiente de desenvolvimento seguindo estes passos:

### 1. Criar a imagem Docker  
No diretório raiz do projeto, execute:  
```bash
docker-compose up --build
```

### 2. Iniciar o contêiner  
Após a criação da imagem, inicie o contêiner:  
```bash
docker-compose up -d
```
> A flag `-d` executa o contêiner em segundo plano.

### 3. Verificar os contêineres em execução  
Para listar todos os contêineres, incluindo os parados, utilize:  
```bash
docker ps -a
```
