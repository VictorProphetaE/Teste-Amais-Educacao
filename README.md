# Visão Geral do Projeto

Este projeto foi desenvolvido conforme os requisitos solicitados para o teste da empresa Amais Educação. O objetivo é criar um sistema de cadastro de currículos utilizando a linguagem de programação PHP, para internet e banco de dados (MySQL ou SQLite).

## Requisitos do Projeto

1. Desenvolver um sistema de cadastro de currículos com PHP e banco de dados.
2. Página de registro onde os usuários podem se registrar como empregador ou candidato.
3. Página de login onde os usuários podem acessar um menu específico com base na escolha de ser empregador ou candidato.
4. Páginas de acesso para candidatos:
   - Página de cadastro.
   - Página de visualização do currículo.
   - Página de atualização do currículo.
   - Logout.
   A página de cadastro e atualização do currículo exibem mensagens de inserção ou alteração. Os usuários podem alterar campos já cadastrados.
5. Páginas de acesso para empregadores:
   - Página que lista todos os currículos cadastrados.
   - A lista exibe a "pretensão salarial" de cada candidato, a soma total de "pretensão salarial" e a média de "pretensão salarial".
   - Os salários abaixo da média estão destacados em verde e os acima da média em azul.
6. Os campos de data são formatados automaticamente durante a inserção/alteração. Os usuários podem digitar "dia/mês/ano", mas são salvos na base de dados como "ano-mês-dia".
7. Verificação de login na base de dados antes da inserção e alteração. Mensagem de erro é exibida se o login já existir.

## Banco de Dados Consiste em

Tabela `cadastro` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `empregador` tinyint(1) NOT NULL,
  `candidato` tinyint(1) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp()
)

Tabela `curriculo_candidato` (
  `id` int(11) NOT NULL,
  `id_candidato` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `escolaridade` varchar(255) NOT NULL,
  `cursos_especializacoes` text NOT NULL,
  `experiencia_profissional` text NOT NULL,
  `pretensao_salarial` decimal(10,2) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `ativo` tinyint(1) NOT NULL DEFAULT 0
)

## Programas Utilizados

- XAMPP: Ferramenta de desenvolvimento web que fornece um ambiente local para executar o PHP e o banco de dados.
- Visual Studio Code: Editor de código-fonte utilizado para escrever o código do projeto.

## Página de Demonstração

Acesse a [página de demonstração](https://desafio-programacao.000webhostapp.com/index.php) para ver o projeto em ação.