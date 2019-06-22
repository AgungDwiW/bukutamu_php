USE bukutamudb;
DROP TABLE IF EXISTS Tamu;
CREATE TABLE tamu (
	uid VARCHAR (15) not null primary key,
	tipeid VARCHAR(15), 
	nama_tamu VARCHAR(50),
	jenis_kelamin BOOLEAN,
	signed_in boolean, 
	perusahaan boolean, 
	image VARCHAR(50), 
	saved boolean
	);

DROP table if exists departemen;
CREATE table departemen (
	id int not null auto_increment primary key, 
	nama_departemen varchar (50), 
	penanggujawab varchar (50), 
	email varchar(50)
	
	);

drop table if exists year;
create table year(
	year int
);

drop table if exists kedatangan;
create table kedatangan (
	id int not null auto_increment primary key, 
	tanggal_datang datetime, 
	tanggal_keluar datetime, 
	keperluan varchar (50), 
	suhu_badan float(1),
	luka boolean, 
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

drop table if exists pelaporan;
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

drop table if exists user;
create table user(
	pk int not null auto_increment primary key,
	user varchar(30),
	pass varchar(30),
	is_super boolean
);