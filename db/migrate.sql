DROP DATABASE IF EXISTS bukutamudb;
CREATE DATABASE bukutamudb;

USE bukutamudb;
DROP TABLE IF EXISTS kedatangan;
DROP TABLE IF EXISTS pelaporan;
DROP TABLE IF EXISTS pengampunan;
DROP TABLE IF EXISTS departemen;
DROP TABLE IF EXISTS karyawan;
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
	tipe varchar(20),
	parent int
);


CREATE TABLE area(
	id int not null primary key auto_increment,
	nama_area varchar(50)
);


create table karyawan(
	id int not null auto_increment primary key,
	nik varchar(10),
	nama varchar(40),
	unique(nik)
);

CREATE TABLE tamu (
	id int not null primary key auto_increment,
	nama_tamu VARCHAR(50),
	jenis_kelamin varchar(1),
	signed_in boolean, 
	terakhir_datang datetime,
	image VARCHAR(50), 
	nohp varchar(20),
	count_pelanggaran int,
	blok boolean,	
	terakhir_ind date,
	terakhir_count date,
	tipe int,
	 foreign key fk_tamu_tipe (tipe)
    references tipe_tamu(id)
    on delete set null,	
	);

create table uid_tamu(
	id int not null primary key auto_increment,
	uid varchar(15),
	tipeid varchar (15),
	id_tamu int,
	unique(uid),
	foreign key uid_tamu(id_tamu)
	references tamu(id)
	on delete cascade
);


create table kartu_tamu(
	id int not null auto_increment primary key,
	tipe_kartu int,
	nomor_kartu int,
	uid varchar(50),
	id_tamu int,
	unique(uid),
	foreign key fk_kartu_tipe(tipe_kartu)
	references tipe_tamu(id)
	on DELETE CASCADE,
	foreign key kartu_tamu (id_tamu)
	references tamu(id)
	on delete set null
	
);

CREATE table departemen (
	id int not null auto_increment primary key, 
	nama_departemen varchar (50), 
	penanggungjawab varchar (50), 
	email varchar(50)
	
	);



create table kedatangan (
	id int not null auto_increment primary key, 
	id_tamu int,
	tanggal_datang datetime, 
	tanggal_keluar datetime, 
	durasi int,
	suhu_badan float(1),
	luka boolean, 
	sakit varchar(50), 
	bertemu varchar(50),
	keperluan varchar (50), 
    departemen int,
    signedout boolean,
    id_keplek int,
    foreign key fk_tamu_keplek (id_keplek)
    references kartu_tamu(id)
    on delete set null,
	foreign key fk_tamu_ked (id_tamu)
	references tamu(id)
	ON DELETE CASCADE,
	foreign key fk_dep_ked(departemen)
	references departemen(id)
	ON DELETE SET NULL
	);


create table pelaporan(
	id int not null auto_increment primary key,
	id_karyawan int,
	nama_pelapor varchar(40),
	id_tamu int,
	departemen int,
	tanggal_pelanggaran date,
	tanggal_pelaporan datetime,
	tipe_12 varchar(50),
	subkategori varchar(50),
	positif boolean,
	area int,
	ap varchar(100),
	keterangan varchar (100),
	foreign key fk_pelanggar_kary (id_karyawan)
	references karyawan(id)
	on DELETE SET NULL,
	foreign key fk_pelanggar (id_tamu)
	references tamu(id)
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
    is_superman boolean,
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
	id_karyawan int,
	id_tamu int,
	mou varchar(50),
	tanggal_pengampunan date,
	foreign key fk_pengampunan (id_tamu)
	references tamu(id)
	on DELETE CASCADE,
	foreign key fk_pengampunan_kary (id_karyawan)
	references karyawan(id)
	on DELETE SET NULL
);




insert into user(
	user, pass, is_super, is_superman)
	values ('pandaan0', 'ad82b52fc58558e72ba3f4837cd4ed60', true, true);


insert into setting(nama, value) values
	("max_temp",36);

insert into setting(nama, value) values
	("max_pel",3);

insert into setting(nama, value) values
	("max_ind", 15);

insert into setting(nama, value) values
	("autoreset", 6);

insert into setting(nama, value) values
	("autodelete", 24);

SET GLOBAL event_scheduler = ON;
use bukutamudb;

DROP EVENT IF EXISTS `autoresetpel`;
DROP EVENT IF EXISTS `autodelete_ked` ;
DROP EVENT IF EXISTS `autodelete_pel` ;
DROP EVENT IF EXISTS `autodelete_res`;

CREATE EVENT `autoresetpel` 
ON SCHEDULE EVERY 1 MONTH 
ON COMPLETION PRESERVE 
ENABLE 
DO 
UPDATE tamu SET count_pelanggaran = 0 , terakhir_count =STR_TO_DATE(CURDATE(), '%Y-%m-%d'), blok = 0
where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL 6 MONTH > STR_TO_DATE(`terakhir_count`, '%Y-%m-%d');

CREATE EVENT `autodelete_ked` 
ON SCHEDULE EVERY 1 MONTH 
ON COMPLETION PRESERVE 
ENABLE 
DO 
DELETE FROM kedatangan
where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL 24 MONTH > STR_TO_DATE(`tanggal_datang`, '%Y-%m-%d');


CREATE EVENT `autodelete_pel` 
ON SCHEDULE EVERY 1 MONTH 
ON COMPLETION PRESERVE 
ENABLE 
DO 
DELETE FROM pelaporan
where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL 24 MONTH > STR_TO_DATE(`tanggal_pelanggaran`, '%Y-%m-%d');



CREATE EVENT `autodelete_res` 
ON SCHEDULE EVERY 1 MONTH 
ON COMPLETION PRESERVE 
ENABLE 
DO 
DELETE FROM pengampunan
where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL 24 MONTH > STR_TO_DATE(`tanggal_pengampunan`, '%Y-%m-%d');


