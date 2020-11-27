create database bd_ecommerce;

use bd_ecommerce;

create table tb_admin(
tb_admin_id integer not null auto_increment primary key ,
tb_admin_nome varchar(255) not null,
tb_admin_senha varchar(255) not null
);

create table tb_cliente(
tb_cliente_id integer not null auto_increment primary key,
tb_cliente_nome varchar(255) not null,
tb_cliente_endereco varchar(255) not null,
tb_cliente_email varchar(255) not null ,
tb_cliente_senha varchar(45) not null ,
tb_cliente_cpf varchar(50) not null,
tb_cliente_bairro varchar(255)  not null,
tb_cliente_cidade varchar(255)  not null,
tb_cliente_tel varchar (45)  not null,
tb_cliente_complemento varchar(128) 
);

create table tb_fornecedor(
tb_fornecedor_id integer not null auto_increment primary key ,
tb_fornecedor_nome varchar(255) not null,
tb_fornecedor_cnpj varchar(50) not null,
tb_fornecedor_endereco  varchar(255) not null,
tb_fornecedor_bairro varchar(255),
tb_fornecedor_cidade varchar(255),
tb_fornecedor_email varchar(255),
tb_fornecedor_tel varchar (45)
);

create table  tb_produto(
tb_produto_id integer not null auto_increment primary key ,
tb_produto_nome varchar(255) not null,
tb_produto_estoque integer not null,
tb_produto_preco decimal(10,2) not null,
tb_produto_imagem varchar(100)
);

create table tb_carrinho(
tb_carrinho_id integer not null auto_increment primary key,
tb_carrinho_preco decimal(10,2) not null,
tb_carrinho_quantidade integer not null,
tb_carrinho_ativo integer not null -- 0 = pago, 1 = ativo , 2= pagamento pendente--
);
create table  tb_venda(
tb_venda_id integer not null auto_increment primary key ,
tb_venda_data varchar(128) not null
); 

-- tabela produto 
alter table tb_produto
add column tb_fornecedor_id integer not null;

alter table tb_produto
add constraint pk_produto_fk_fornecedor
foreign key (tb_fornecedor_id)
references tb_fornecedor(tb_fornecedor_id);

-- tabela venda 



-- ligação venda e carrinho

alter table tb_venda
add column tb_carrinho_id integer not null; 

  alter table tb_venda
 add constraint pk_venda_fk_carrinho
foreign key (tb_carrinho_id)
references tb_carrinho(tb_carrinho_id);



-- ligação  tb_carrinho  com cleinte
alter table tb_carrinho
add column tb_cliente_id integer not null;

alter table tb_carrinho
add constraint pk_cliente_has_fk_carrinho
foreign key (tb_cliente_id)
references tb_cliente(tb_cliente_id);


-- ligação tb_carrinho com produto

alter table tb_carrinho
add column tb_produto_id integer not null;

alter table tb_carrinho
add constraint pk_produto_has_fk_carrinho
foreign key (tb_produto_id)
references tb_produto(tb_produto_id);




-- teste

alter table tb_venda
add column tb_cliente_id integer not null; 
  alter table tb_venda
 add constraint pk_venda_fk_cliente
foreign key (tb_cliente_id)
references tb_cliente(tb_cliente_id);

alter table tb_venda
add column tb_venda_metodopag Integer not null;-- 0 = dinheiro -- 1= cartao



select * from tb_produto;

select * from tb_cliente