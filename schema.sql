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

create table tent_captura( id_tentativa   int primary key auto_increment
				 , id_usuario     int not null
				 , qtd_tentativas int not null
				 , data_tentativa varchar(10) not null
				 , foreign key (id_usuario) references usuario(id_usuario)
				 );

create table pokemons( seq_pokemon    int primary key auto_increment
                     , id_pokemon     int          not null
                     , id_usuario     int          not null
                     , desc_pokemon   varchar(250) not null
                     , pokemon_url    varchar(250) not null
                     , pokemon_sprite LONG VARCHAR not null
                     , pokemon_icon   LONG VARCHAR not null
                     , level_pokemon  int          not null
                     , foreign key (id_usuario) references usuario(id_usuario)
                     );