show databases;

create database contacts_laravel_app;

use contacts_laravel_app;

show tables;

create table contact(
	id int primary key,
    name varchar(45),
    last_name varchar(45),
    age smallint,
    gender char(1),
    email varchar(60),
    phone_number varchar(25),
    created_at timestamp,
    updated_at timestamp
);

describe contact;

select * from contact;

drop table contact;

truncate table migrations;

select * from migrations;

select * from contact where (name LIKE "%%" and last_name LIKE "%%" and phone_number LIKE "%30%" and email LIKE "%%");

select * from contact where name = 'Olivia';