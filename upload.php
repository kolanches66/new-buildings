<?php
	$uploaddir = '/uploads/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

	echo '<pre>';
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		echo "���� ��������� � ��� ������� ��������.\n";
	} else {
		echo "��������� ����� � ������� �������� ��������!\n";
	}

	echo '��������� ���������� ����������:';
	print_r($_FILES);
	echo '</pre>';
?>