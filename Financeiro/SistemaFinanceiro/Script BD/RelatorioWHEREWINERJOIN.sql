-- where: Comando SQL FILTRO, onde Voce direciona a operação
-- Inner join: Comando SQL que permite realizar, pesquisas avançadas (SELECT AVANÇADO)
-- like: Tudo (TODO Condetudo)
-- AS (as): Forma de dar Apelido para tabelas do Banco de Dados



-- RELATORIOS DO BANCO DE DADOS:
SELECT nome_usuario, data_cadastro
	from tb_usuario
where nome_usuario like '%a%';

select  nome_usuario, data_cadastro
	from tb_usuario
where data_cadastro between '2022/10/17' and '2022/10/24';

select id_categoria, nome_categoria
	from tb_categoria
where nome_categoria between '2022/10/01' and '2022/10/24';

select banco_conta, agencia_conta, saldo_conta
	from tb_conta
where id_usuario = 1;

-- RELATORIO DE MULTIPLAS TABELAS COM FILTRO (INNER JOIN COM WHERE)

select nome_usuario, banco_conta, agencia_conta, saldo_conta
	from tb_usuario
inner Join tb_conta
	on tb_usuario.id_usuario = tb_conta.id_usuario
where tb_conta.id_usuario = 1 ;

-- COMANDO AS DO SQL: APELIDO DADO PARA AS TABELAS DO BANCO DE DADOS
select nome_usuario, banco_conta,
