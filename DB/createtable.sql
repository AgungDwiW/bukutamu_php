USE bukutamudb;
DROP TABLE IF EXISTS kedatangan;
DROP TABLE IF EXISTS pelaporan;
DROP TABLE IF EXISTS departemen;
DROP TABLE IF EXISTS year;
DROP TABLE IF EXISTS tamu;
DROP TABLE IF EXISTS user;

CREATE TABLE tamu (
	id int not null primary key auto_increment,
	uid VARCHAR (15) ,
	tipeid VARCHAR(15), 
	nama_tamu VARCHAR(50),
	jenis_kelamin varchar(1),
	signed_in boolean, 
	perusahaan boolean, 
	image VARCHAR(50), 
	nohp varchar(20),
	saved boolean,
	unique (uid)
	);


CREATE table departemen (
	id int not null auto_increment primary key, 
	nama_departemen varchar (50), 
	penanggungjawab varchar (50), 
	email varchar(50)
	
	);


create table year(
	year int
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
	foreign key fk_tamu_ked (tamu)
	references tamu(uid)
	ON DELETE CASCADE,
	foreign key fk_dep_ked(departemen)
	references departemen(id)
	on DELETE CASCADE
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
	ap1 varchar(50),
	ap2 varchar(50),
	keterangan varchar (100),
	pelanggar varchar(15),
	departemen int,
	foreign key fk_pelanggar (pelanggar)
	references tamu(uid)
	on DELETE CASCADE,
	foreign key fk_dep_pel(departemen)
	references departemen(id)
	on delete cascade
);


create table user(
	pk int not null auto_increment primary key,
	user varchar(30),
	pass varchar(30),
	is_super boolean,
	unique (user)
);

use bukutamudb;

insert into user(
	user, pass, is_super)
	values ('admin', 'f6fdffe48c908deb0f4c3bd36c032e72', true);


insert into departemen(nama_departemen, penanggungjawab, email) 
	values('testdep1', 'test1', 'test.test@test1');

insert into departemen(nama_departemen, penanggungjawab, email) 
	values('testdep2', 'test2', 'test.test@test2');
