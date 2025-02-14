CREATE DATABASE IF NOT EXISTS Madariaga_Zaloa_DWES04;
use Madariaga_Zaloa_DWES04;
create table if not exists usuarios(id int auto_increment primary key , nombre varchar(50) NOT NULL, contraseña varchar (255)NOT NULL , rol varchar(25)NOT NULL); 
create table if not exists reservas(id int auto_increment primary key, id_usuario int  NOT NULL, habitacion varchar (40)not null, fecha_de_entrada date NOT NULL, fecha_de_salida date NOT NULL , CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE);
