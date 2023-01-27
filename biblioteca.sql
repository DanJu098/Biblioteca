create database biblioteca;
use biblioteca;

create table tbfuncionario (codigo int primary key auto_increment,
                            nome varchar(90),
                            fone int,
                            email varchar (90),
                            periodo varchar(90),
                            senha varchar(30),
                            perfil int references tbperfil
                            );
                           
                   insert into tbfuncionario (nome, fone, email, periodo,  senha, perfil) values ('daniel',98547632,'daniel@gmail.com','matutino','1234',1);
                   insert into tbfuncionario (nome, fone, email, periodo,  senha, perfil) values ('marcos',56987456,'marcos@gmail.com','noturno','1122',2); 
                   

                      
create table tbusuario (codigo int primary key auto_increment,
						nome varchar(90),
                        curso varchar(90),
                        fone int,
                        email varchar(30),
						login varchar(90),
						senha varchar(30),
                        qtdLivro int,
                        endereco varchar (90),
                        perfil int references tbperfil
                        );
                        
create table tbperfil (cod char(2) primary key unique,
					nome varchar(20) not null
                    );
                    
insert into tbperfil values (1, 'PDM');
insert into tbperfil values (2, 'Funcionário');
insert into tbperfil values (3, 'Cliente');                       
                       
                       
                       
create table tblivro (codigo int primary key auto_increment,
					  titulo varchar(90),
                      autor varchar(90),
                      genero varchar (90),
                      editora varchar(90),
                      paginas int,
                      isbn varchar (30),
                      caminho varchar(100),
					  dt_cad TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                      );
                      
create table tbgenero(cod int primary key,
						genero varchar(20)
                        );
                        
insert into tbgenero values (1, 'Terror');
insert into tbgenero values (2, 'Mistério');
insert into tbgenero values (3, 'Comédia');
insert into tbgenero values (4, 'Drama');
insert into tbgenero values (5, 'Romance');
insert into tbgenero values (6, 'Aventura');
insert into tbgenero values (7, 'Histórico');
insert into tbgenero values (8, 'Biografia');
insert into tbgenero values (9, 'Ação');
insert into tbgenero values (10, 'Ficção');

create table tbestoque (codigo int primary key auto_increment,
						codigolivro int references tblivro,
                        qtde int,
                        qtdeAtual int
                        );
                        
create table comanda (codigo int primary key auto_increment,
					  codigocliente int references tbusuario,
                      codigolivro int references tblivro,
                       datasaida date,
                        datadevolucao date,
                        multa int
                        );
                        
                        INSERT INTO tblivro(titulo, autor,genero,editora,paginas,isbn,caminho) VALUES ('Sam Smith','Sam Smith',1,'LBTQIA+',1,12,'Fotos_Livros/632b98436638a.jpg');
						INSERT INTO tblivro(titulo, autor,genero,editora,paginas,isbn,caminho) VALUES ('Cirilo','Cirilo du Grau',2,'Aleph da Colômbia',123,123,'Fotos_Livros/632b99d314dc9.jpg');
                        
                        select * from tbfuncionario;
                        select * from tblivro;
                        select * from tbusuario;
                        select * from tbestoque;
                        select * from comanda;