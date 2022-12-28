select nome_usuario, nome_categoria
	from tb_usuario
inner join tb_categoria
	on tb_usuario.id_usuario = tb_categoria.id_usuario
where tb_categoria.id_categoria;

select nome_usuario, email_usuario, banco_conta, saldo_conta, numero_conta
	from tb_usuario
inner join tb_conta
	on tb_usuario.id_usuario = tb_conta.id_usuario
where tb_conta.id_usuario;

select nome_categoria, nome_empresa, nome_usuario, data_movimento, valor_movimento, tipo_movimento
	from tb_categoria
inner join tb_empresa
	on tb_categoria.id_usuario = tb_empresa.id_usuario
inner join tb_usuario
	on tb_empresa.id_usuario = tb_usuario.id_usuario
inner join tb_movimento
	on tb_usuario.id_usuario = tb_movimento.id_movimento;

