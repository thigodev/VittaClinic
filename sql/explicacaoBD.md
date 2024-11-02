1. Tabela admin
Essa tabela armazena informações dos administradores.
 
Campos:

id: Identificador único do administrador (tipo int, não nulo).
nome: Nome do administrador (tipo varchar de 255 caracteres, não nulo).
email: Email do administrador (tipo varchar de 255 caracteres, não nulo).
senha: Senha do administrador (tipo varchar de 255 caracteres, não nulo, provavelmente criptografada).
clinica_id: Referência opcional à clínica que o administrador gerencia (tipo int, pode ser nulo).
Exemplo de Inserção:

(41, 'Thiago', 'thiago@valorant.com', 'hash_da_senha', 23)
2. Tabela clinic
Essa tabela armazena informações sobre as clínicas.

Campos:

id: Identificador único da clínica (tipo int, não nulo).
nome: Nome da clínica (tipo varchar de 255 caracteres, não nulo).
email: Email da clínica (tipo varchar de 255 caracteres, não nulo).
cnpj: CNPJ da clínica (tipo varchar de 18 caracteres, não nulo).
senha: Senha da clínica para login (tipo varchar de 255 caracteres, não nulo, provavelmente criptografada).
Exemplo de Inserção:

(23, 'Teste', 'teste@gmail.com', '12345678', 'hash_da_senha')
3. Tabela consulta
Essa tabela armazena informações sobre as consultas médicas.

Campos:

id: Identificador único da consulta (tipo int, não nulo).
paciente_email: Email do paciente (tipo varchar de 255 caracteres, não nulo).
medico_crm: CRM do médico responsável pela consulta (tipo varchar de 50 caracteres, não nulo).
data_consulta: Data da consulta (tipo date, não nulo).
horario_consulta: Horário da consulta (tipo time, não nulo).
clinica_id: Identificador da clínica onde a consulta será realizada (tipo int, pode ser nulo).
Exemplo de Inserção:

(4, 'games@gmail.com', '12345678', '2024-09-06', '12:03:00', 23)
4. Tabela medico
Essa tabela armazena informações dos médicos.

Campos:

id: Identificador único do médico (tipo int, não nulo).
nome: Nome do médico (tipo varchar de 255 caracteres, não nulo).
email: Email do médico (tipo varchar de 255 caracteres, não nulo).
especialidade: Especialidade do médico (tipo varchar de 255 caracteres, não nulo).
crm: CRM do médico (tipo varchar de 20 caracteres, não nulo).
senha: Senha para login (tipo varchar de 255 caracteres, não nulo, criptografada).
clinica_id: Identificador da clínica onde o médico trabalha (tipo int, pode ser nulo).
tipo: Tipo do médico (tipo varchar de 255 caracteres, valor padrão NULL).
Exemplo de Inserção:

(5, 'Você', 'voce@gmail.com', 'Ortopediatra', '12345678', 'hash_da_senha', 23, 'Médico')
