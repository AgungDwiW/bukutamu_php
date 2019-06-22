use bukutamudb;

insert into user(
	user, pass, is_super)
	values ('admin', 'f6fdffe48c908deb0f4c3bd36c032e72', true);


insert into departemen(nama_departemen, penanggungjawab, email) 
	values('testdep1', 'test1', 'test.test@test1');

insert into departemen(nama_departemen, penanggungjawab, email) 
	values('testdep2', 'test2', 'test.test@test2');
