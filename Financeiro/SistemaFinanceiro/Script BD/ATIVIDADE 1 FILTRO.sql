select id_movimento, tipo_movimento, data_movimento, valor_movimento
	from tb_movimento
where id_usuario = 1 ;

select id_movimento, tipo_movimento, data_movimento, valor_movimento
	from tb_movimento
where id_usuario = 13;

select nome_usuario
	from tb_usuario
where nome_usuario like '%a%';

select nome_usuario
	from tb_usuaio
where nome_usuario like '%b%';

select nome_usuario
	from tb_usuaio
where nome_usuario like '%d%';

select nome_usuario, data_cadastro
	from tb_usuario
where data_cadastro between '2022/09/28' and '2022/10/24';

select nome_usuario, data_cadastro
	from tb_movimento
where data_cadastro between '2022/09/28' and '2022/10/24';

