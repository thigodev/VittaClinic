- AdminPadrao.php: Essa classe cuida dos admins de uma clínica, permitindo cadastrar, apagar e listar os admins no banco de dados.
- Clinica.php: Gerencia o cadastro de clínicas, permitindo criar, apagar e listar clínicas no sistema, tudo direto no banco de dados.
- Consulta.php: Controla as consultas dos pacientes, com funções para adicionar, remover e procurar consultas por email do paciente.
- Paciente.php: Cuida dos pacientes, permitindo cadastro, remoção e listagem dos pacientes por clínica, além de ver suas consultas.
- User.php: Classe principal que define funções básicas (cadastrar, apagar, listar), sendo usada pelas outras classes como base.
- Medico.php: CLasse que cadastra, remove e lista médicos no sistema, incluindo especialidade e CRM... 
também permite buscar consultas relacionadas ao médico, com operações realizadas no banco de dados.
