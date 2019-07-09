DROP DATABASE IF EXISTS bukutamudb;
CREATE DATABASE bukutamudb;

USE bukutamudb;
DROP TABLE IF EXISTS kedatangan;
DROP TABLE IF EXISTS pelaporan;
DROP TABLE IF EXISTS departemen;
DROP TABLE IF EXISTS year;
DROP TABLE IF EXISTS tamu;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS session;


CREATE TABLE setting(
	nama varchar(50) primary key,
	value int
);

CREATE TABLE tipe_tamu(
	id int not null primary key auto_increment,
	tipe varchar(20)
);

CREATE TABLE area(
	id int not null primary key auto_increment,
	nama_area varchar(50)
);

CREATE TABLE tamu (
	id int not null primary key auto_increment,
	uid VARCHAR (15) ,
	tipeid VARCHAR(15), 
	nama_tamu VARCHAR(50),
	jenis_kelamin varchar(1),
	signed_in boolean, 
	terakhir_datang datetime,
	perusahaan varchar(50), 
	image VARCHAR(50), 
	nohp varchar(20),
	saved boolean,
	count_pelanggaran int,
	blok boolean,	
	tipe int,
	terakhir_ind date,
	unique (uid),
	foreign key fk_usr_tip(tipe)
	references tipe_tamu(id)
	ON DELETE SET NULL
	);


CREATE table departemen (
	id int not null auto_increment primary key, 
	nama_departemen varchar (50), 
	penanggungjawab varchar (50), 
	email varchar(50)
	
	);



create table kedatangan (
	id int not null auto_increment primary key, 
	tanggal_datang datetime, 
	tanggal_keluar datetime, 
	keperluan varchar (50), 
	suhu_badan float(1),
	luka boolean, 
	durasi int,
	sakit varchar(50), 
	signedout boolean,
    tamu varchar(15),
    departemen int,
    bertemu varchar(50),
    id_keplek int,
	foreign key fk_tamu_ked (tamu)
	references tamu(uid)
	ON DELETE CASCADE,
	foreign key fk_dep_ked(departemen)
	references departemen(id)
	ON DELETE SET NULL
	);


create table pelaporan(
	id int not null auto_increment primary key,
	nama_pelapor varchar(50),
	uid_pelapor varchar(50),
	tanggal_pelanggaran date,
	tanggal_pelaporan datetime,
	tipe_12 varchar(50),
	subkategori varchar(50),
	positif boolean,
	area int,
	ap varchar(100),
	keterangan varchar (100),
	pelanggar varchar(15),
	departemen int,
	foreign key fk_pelanggar (pelanggar)
	references tamu(uid)
	on DELETE CASCADE,
	foreign key fk_dep_pel(departemen)
	references departemen(id)
	ON DELETE SET NULL,
	foreign key fk_are_pel(area)
	references area(id)
	ON DELETE SET NULL
);


create table user(
	id int not null auto_increment primary key,
	user varchar(30),
	pass varchar(40),
	is_super boolean,
	unique (user)
);

create table session(
	id int not null auto_increment primary key,
	session_key varchar(100),
	is_super boolean,
	is_superman boolean
);

create table pengampunan(
	id int not null auto_increment primary key,
	uid_pengampun varchar(15),
	pelanggar varchar(15),
	nama_pengampun varchar(50),
	mou varchar(50),
	foreign key fk_pengampunan (pelanggar)
	references tamu(uid)
	on DELETE CASCADE
);

use bukutamudb;

insert into user(
	user, pass, is_super)
	values ('admin', 'f6fdffe48c908deb0f4c3bd36c032e72', true, true);


insert into setting(nama, value) values
	("max_temp",36);

insert into setting(nama, value) values
	("max_pel",3);

insert into setting(nama, value) values
	("max_ind", 15);

insert into departemen(nama_departemen, penanggungjawab, email) values
	("TestDep1", "testman", "pif.zwei@gmail.com");

insert into departemen(nama_departemen, penanggungjawab, email) values
	("TestDep2", "testman", "pif.zwei@gmail.com");

insert into tipe_tamu(tipe) values ("visitor");

insert into tipe_tamu(tipe) values ("vendor");

insert into tipe_tamu(tipe) values ("PKL");

insert into area (nama_area) values("1 : Ismaya");
insert into area (nama_area) values("2 : Srikandi");