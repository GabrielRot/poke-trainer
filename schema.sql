create database db_poketrainer;

use db_poketrainer;

create table usuario( id_usuario int primary key auto_increment
                    , logon      varchar(80)  not null
                    , senha      varchar(80)  not null
                    , nome       varchar(150) not null
                    , nascimento varchar(10)  not null);

insert  usuario( logon
                   , senha 
                   , nome
                   , nascimento
                   )
             values( 'ash'
                   , '1234'
                   , 'GABRIEL'
                   , '07/10/2003'
                   );